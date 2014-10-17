<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Creating Libraries</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>
        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">

        <h1 class="active">Creating libraries</h1>

        <div class="content2-container line-box">
        <div class="content2-container-1col">

        <h2 id="abstract">Abstract</h2>

        <p>This tutorial will give you some hands on experience on:</p>

        <ul>
            <li>how to create libraries in Rock</li>
            <li>how to embed them into the build system of Rock</li>
        </ul>

        <p>If you don’t want to execute the following steps by yourself, the result can
            also be found in the package ‘tutorials/’ after you <a href="index.php?page=introduction#installing">installed the tutorial package set</a>.</p>

        <p>For this tutorial it is assumed that your autoproj installation can be found in ~/dev.</p>
        <br/>
        <h2 id="creating-libraries">Creating libraries</h2>
        <p>Before you start developing components, you will need to think about the functionality that is required for your component. This tutorial teaches you how to write a message producer and a message consumer component, which will pass timestamped messages inbetween each other.
            For the message producer and the consumer we will create a message library to provide message creation and message printing functionality. This library will make use of the existing package base/types which simplifies creation of timestamps.</p>

        <p>Now, that it is clear what functionality is needed you can start writing the library.
            Note, that Rock strongly suggests to encapsulate your main functionality in libraries. Thus, your library code remains independent of the actual framework in use, and can be easily reused and maintained separately from any framework that wraps this functionality.</p>

        <p>Rock allows you to create a C++ library from an existing template. Calling the
            command ‘rock-create-lib’ starts a command line dialog to create a library
            called ‘tutorials/message_driver’. Remember: ~/dev is here the path to the Rock installation. It might differ on your machine.</p>

        <div class="CodeRay">
            <div class="code"><pre>~/dev$ rock-create-lib tutorials/message_driver
</pre></div>
        </div>

        <p>Once called the create script a command line dialog is started, that will request basic information to configure the template for you. The following output is the output of the script AND the expected answers. Do not copy/paste the whole block at once !</p>

        <div class="CodeRay">
            <div class="code"><pre>Initialized empty Git repository
in ~/dev/tutorials/message_driver/.git/
Do you want to start the configuration of
the cmake project: message_driver
Proceed [y|n]
y
------------------------------------------
We require some information to update the manifest.xml
------------------------------------------
Brief package description (Press ENTER when finished):
A message_driver for the basic Rock tutorial
Long description:
This is a library that allows message production
and message handling for the the basic Rock tutorial
Author:
New user
Author email:
new-user@rock-robotics.org
Url (optional):

Enter your dependencies as a comma separated list.
Press ENTER when finished:
base/types
Initialized empty shared Git repository
in ~/dev/tutorials/message_driver/.git/
[master (root-commit) 37aa552] Initial commit
8 files changed, 108 insertions(+), 0 deletions(-)
create mode 100644 CMakeLists.txt
create mode 100644 INSTALL
create mode 100644 LICENSE
create mode 100644 README
create mode 100644 manifest.xml
create mode 100644 src/CMakeLists.txt
create mode 100644 src/Dummy.cpp
create mode 100644 src/Dummy.hpp
create mode 100644 src/Main.cpp
create mode 100644 src/dummyproject.pc.in
Done.
</pre></div>
        </div>

        <p>The newly created package comes in a ready to run after a fashion: you can build and install it right away using the build tool <a href="/documentation/autoproj/basic_usage.html">autoproj</a></p>

        <pre>amake tutorials/message_driver</pre>

        <p class="note note-warning"><strong><em>NOTE</em></strong>: The template project will generate several file for you in the src/ and
            test/ directories. This is meant to give you an example, but these files are
            usually deleted as soon as you start developing the library. Don’t forget to
            remove the corresponding references from src/CMakeLists.txt and
            test/CMakeLists.txt as well.</p>
        <br/>
        <h3 id="adding-the-required-functionality">Adding the required functionality</h3>
        <p>The library does not contain message handling capabilities yet. So, we create
            three new files, i.e. a header file Messages.hpp which will contain the message
            type that is used to transport message between components, and a header and
            source file for the MessageDriver. Put all files into the src/ folder of the
            newly created package.</p>

        <p class="note note-warning"><strong><em>NOTE</em></strong>: Rock recommends to stick to use CamelCase for new structures, and to
            name the files after the class it defines (i.e. Message.hpp defines the Message
            structure, MessageDriver.hpp declares the MessageDriver class and
            MessageDriver.cpp defines it). However, due to historic reasons not all packages
            of Rock conform to this style. See <a href="http://rock.opendfki.de/wiki/WikiStart/Standards/RG4">these guidelines</a>
            for more information</p>

        <p>In Rock, common C++ types are defined <a href="/pkg/base/types/index.html">in the base/types package</a>. If some type you need is defined here, it is <strong>highly recommended</strong>
            to use the common type. In our case, we want to timestamp the message that our
            library will manipulate.  If we have a look at the base/types API documentation
            (follow the API documentation link from the package page above), we can see that
            it defines a base::Time type that suits our needs.</p>

        <p>First things first, we need to declare the dependency on the base/types package.
            Edit manifest.xml and make sure that the following line is there (it should
            already be):</p>

        <div><div class="CodeRay">
                <div class="code"><pre><span style="color:#070;font-weight:bold">&lt;depend</span> <span style="color:#b48">package</span>=<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">base/types</span><span style="color:#710">"</span></span> <span style="color:#070;font-weight:bold">/&gt;</span>
</pre></div>
            </div>
        </div>

        <p>The message class definition will be contained in a header called
            src/Message.hpp, to follow Rock naming guidelines (a Message class should be
            declared in the src/Message.hpp header). It should contain the following code:</p>

        <div><div class="CodeRay">
                <div class="code"><pre><span style="color:#579">#ifndef</span> _MESSAGE_DRIVER_MESSAGE_HPP_
<span style="color:#579">#define</span> _MESSAGE_DRIVER_MESSAGE_HPP_

<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;string&gt;</span>
<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;base/time.h&gt;</span>

<span style="color:#080;font-weight:bold">namespace</span> message_driver
{
    <span style="color:#080;font-weight:bold">struct</span> Message
    {
        <span style="color:#777">// The message content </span>
        std::<span style="color:#0a8;font-weight:bold">string</span> content;

        <span style="color:#777">// The timestamp when the message was created</span>
        base::Time time;

        <span style="color:#777">// Default Constructor -- required</span>
        Message()
                : content()
                , time(base::Time::now())
        {
        }

        Message(<span style="color:#088;font-weight:bold">const</span> std::<span style="color:#0a8;font-weight:bold">string</span>&amp; msg)
                : content(msg)
                , time(base::Time::now())
        {
        }
    };

}
<span style="color:#579">#endif</span> <span style="color:#777">// _MESSAGE_DRIVER_MESSAGE_HPP_</span>
</pre></div>
            </div>
        </div>

        <p>To follow the Rock guidelines, the MessageDriver class should be declared in
            src/MessageDriver.hpp and defined in src/MessageDriver.cpp.
            src/MessageDriver.hpp should therefore contain:</p>

        <div><div class="CodeRay">
                <div class="code"><pre><span style="color:#579">#ifndef</span> _MESSAGE_DRIVER_HPP_
<span style="color:#579">#define</span> _MESSAGE_DRIVER_HPP_

<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;message_driver/Message.hpp&gt;</span>

<span style="color:#080;font-weight:bold">namespace</span> message_driver
{

<span style="color:#080;font-weight:bold">class</span> <span style="color:#B06;font-weight:bold">MessageDriver</span>
{

<span style="color:#088;font-weight:bold">public</span>:
    <span style="color:#777">/**
     * Create a timestamped message
     * \return A timestamped message
     */</span>
    Message createMessage();

    <span style="color:#777">/**
     * Print a message to stdout
     * \param msg Message to be printed
     */</span>
    <span style="color:#088;font-weight:bold">void</span> printMessage(<span style="color:#088;font-weight:bold">const</span> Message&amp; msg);
};

}

<span style="color:#579">#endif</span> <span style="color:#777">// _MESSAGE_DRIVER_HPP_</span>
</pre></div>
            </div>
        </div>

        <p>And, finally, the driver implementation creates the timestamped message, and is
            in src/MessageDriver.cpp:</p>

        <div><div class="CodeRay">
                <div class="code"><pre><span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">"MessageDriver.hpp"</span>
<span style="color:#579">#include</span> <span style="color:#B44;font-weight:bold">&lt;iostream&gt;</span>

<span style="color:#080;font-weight:bold">namespace</span> message_driver
{

Message MessageDriver::createMessage()
{
        Message msg(<span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">Message from MessageDriver</span><span style="color:#710">"</span></span>);
        <span style="color:#080;font-weight:bold">return</span> msg;
}

<span style="color:#088;font-weight:bold">void</span> MessageDriver::printMessage(<span style="color:#088;font-weight:bold">const</span> Message&amp; msg)
{
        std::cout &lt;&lt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">[</span><span style="color:#710">"</span></span> &lt;&lt; msg.time.toString()
                  &lt;&lt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">] </span><span style="color:#710">"</span></span> &lt;&lt; msg.content
                  &lt;&lt; std::endl;
}

}
</pre></div>
            </div>
        </div>
        <br/>
        <h3 id="build">Build</h3>

        <p>Once you created a library in Rock integrate it into the build system autoproj.
            The first step towards integration into the build system is adding the newly
            created files to the src/CMakeLists.txt file, since Rock default C++ libraries
            use CMake for the build process. Rock also comes with some CMake macros that
            facilitate setting up libraries, and resolving any required dependencies (have
            a look <a href="../packages/cmake_macros.html">here</a> for details).</p>

<pre>rock_library(message_driver
    SOURCES MessageDriver.cpp
    HEADERS MessageDriver.hpp Message.hpp
    DEPS_PKGCONFIG base-types)

# Do not forget to remove the rock_executable line that
# compiles Main.cpp, as it is not used anymore</pre>

        <p id="add-to-manifest">After adapting the CMakeLists.txt add the package to the build configuration, so
            that eventually you can embedded the library into oroGen components. The easiest
            way to adapt the build configuration is by adding the package to the manifest’s
            layout section. Thus, edit ~/dev/autoproj/manifest and add the package to the
            layout section. Package management in detail is discussed in <a href="/documentation/autoproj/adding_packages.html">Adding
                packages</a></p>

        <p class="note note-warning"><strong><em>NOTE</em></strong>: When adding the package, make sure you use the same indentation as
            the previous line, here ‘- rock.toolchain’. The manifest file is parsed as
            .yaml, and thus relies on proper indentation.</p>

<pre>package_sets:
    - gitorious: rock-toolchain/package_set

# Layout. Note that the rock.base, rock.toolchain
# and orocos.toolchain sets are imported
# by other rock sets.
layout:
    - rock.base
    - rock.toolchain
    - tutorials/message_driver</pre>
        <br/>
        <h3 id="build-it">Build it</h3>
        <p>Just verify that your component builds and you finished your first Rock tutorial.</p>

        <pre>amake</pre>
        <br/>
        <h2 id="summary">Summary</h2>
        <p>In this tutorial you have learned to: </p>

        <ul>
            <li>create a C++ library from the Rock template</li>
            <li>embed new packages into the build system</li>
        </ul>

        <p>In the next tutorial you will learn how to create an oroGen component and embed you library into it.</p>

        </div>
        </div>


        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>