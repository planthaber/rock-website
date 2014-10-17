<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Installing Packages</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>
        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">

            <h1 class="active">Installing Packages</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <h2 id="abstract">Abstract</h2>
                    <p>In this tutorial you will learn how to install the rock widget collection
                        and Vizkit which are libraries for displaying online and log data.</p>
                    <br/>
                    <h2 id="finding-available-packages-and-orogen-tasks">Finding available packages and oroGen tasks</h2>
                    <p>Rock’s <a href="/package_directory.html">package directory</a> gives you a general
                        overview of available ‘standard’ packages, oroGen tasks and types that are used
                        on oroGen tasks. It also gives you links to the API documentation for packages
                        that provide one.  Go have a look.</p>
                    <br/>
                    <h2 id="package--packages-sets">Package / Packages Sets</h2>
                    <p>Every repository which contains libraries, widgets, plugins, orogen tasks or orogen deployments
                        is called a package. They are organised in package sets which define for autoproj how to download
                        and install the containing packages.</p>

                    <p>In this case we want to install two libraries called vizkit and rock_widget_collection. For this we first
                        check if the packages are already installed or defined in one of the known package sets. To do so
                        call on the command line (do not forget to source env.sh first):</p>

<pre>$ autoproj list-config rock_widget_collection
$ autoproj list-config vizkit</pre>

                    <p>If the packages are known to autoproj but not installed, autoproj will tell you this in the <em>warn the following
                            packages are not installed:</em> section on the bottom. In this case you can jump to the
                        section <a href="#installing-packages">Installing Packages</a>.</p>

                    <p>If autoporj reports that it cannot find a match for the packages go to section <a href="#adding-package-sets">Adding Package Sets</a></p>

                    <p>If both packages are already installed autoproj will show a list of packages and dependencies for gui/vizkit and gui/rock_widget_collection. And of course there is nothing left to do.</p>
                    <br/>
                    <h2 id="adding-package-sets">Adding Package Sets</h2>
                    <p>Here it is assumed that autoproj does not know the desired packages at all. In this
                        case you have to tell autoproj where it can find the package sets which contains
                        the desired packages. An easy way to figure out which package set contains
                        which package is by looking at
                        <a href="http://www.rock-robotics.org/package_directory/package_sets/index.html">http://www.rock-robotics.org</a>
                        . After you have find the desired package copy the displayed rock short definition
                        string into the file autoproj/manifest of the current autoproj installation. If you are not using the
                        default rock installation you can also use the displayed autoproj definition string which is independent of
                        rock.</p>

                    <p class="align-center"><img src="package_set_definition.png" alt="Package set definition"></p>

                    <p>In our case the website is reporting the following string for the package gui/vizkit
                        which tells autoproj where to find the corresponding package set rock which in our case
                        also luckily contains rock_widget_collection.
                        To add this package set to your current autoproj installation copy the string to the
                        <em>package_sets:</em> section of the file autoproj/manifest.</p>

                    <p class="warning"><strong><em>NOTE</em></strong>: The manifest is following the yml syntax where you have to use blanks (no tabs).</p>

                    <div class="CodeRay">
                        <div class="code"><pre><span style="color:#606">package_sets</span>:
  - <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">gitorious: rock/package_set</span></span>
</pre></div>
                    </div>

                    <p>Now autoproj nows about all packages which are part of the package sets. If you want to install one of them
                        go to to the next section.</p>
                    <br/>
                    <h2 id="installing-packages">Installing Packages</h2>
                    <p>Here it is assumed that autoproj knows the desired packages and <em>autoproj list-config package_name</em> reports
                        that they are not checkout. If autoproj does not find a match for your desired package go to the section above.</p>

                    <p>To tell autoproj to install known packages which are not part of the current autoproj installation you have
                        to add them to the layout section of the file <em>autoproj/manifest</em> of the current autoproj installation. </p>

                    <p>In this case we want to install the libraries vizkit and rock_widget_collection. For this add the following
                        two lines to the autoproj/manifest layout section. </p>

                    <p class="warning"><strong><em>NOTE</em></strong>: The manifest is following the yml syntax where you have to use blanks (no tabs).</p>

                    <div class="CodeRay">
                        <div class="code"><pre><span style="color:#606">layout</span>:
  - <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">gui/vizkit</span></span>
  - <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">gui/rock_widget_collection</span></span>
</pre></div>
                    </div>

                    <p>Now, if you call <em>amake</em> on the command line autoproj is downloading and installing the two libraries. </p>

                    <pre>$ amake</pre>

                    <p>In this case to check if everything went fine, open a new terminal, go to the
                        autoproj installation, source the environment (source env.sh) and call
                        rock-replay on the command line. You should see a small help, how to use the
                        command line tool, otherwise vizkit was not installed.</p>
<pre>$ source env.sh
$ rock-replay</pre>
                    <br/>
                    <h2 id="summary">Summary</h2>
                    <p>In this tutorial you have learned to: </p>

                    <ul>
                        <li>browse packages in the Rock package directory</li>
                        <li>find an oroGen task that provides or consumes a given datatype</li>
                        <li>install the package</li>
                    </ul>

                </div>
            </div>

        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>