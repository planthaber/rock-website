<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li class="active">Installation</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Installation</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <p>This page explains how to install Rock and where to look for more information (tutorials, …).</p>
                    <br/>
                    <h2 id="level-of-support">Level of support</h2>
                    <p>This section lists the operating systems where Rock is <em>well tested</em>, is <em>untested</em> and where the status is <em>unknown</em>.
                        For <em>well tested</em> operating systems, a build server makes sure that Rock builds
                        fine, and it is known to be actively used. <em>Untested</em> operating systems have
                        had users (so, it did work at some point), but it is unknown whether it is
                        still being actively used. Finally, <em>unknown status</em> operating systems are OSs where
                        Rock should work, but we have had no known report of its success or failure.</p>
                    <br/>
                    <h3 id="well-tested-oss">Well tested OSes</h3>
                    <table>
                        <tbody>
                        <tr>
                            <td><img src="images/ubuntu.png" alt="Ubuntu"></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>Latest LTS and later (currently anything newer than 12.04). We let 6 months after a LTS release before deprecating the previous LTS.</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><img src="images/debian.png" alt="Debian"></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>testing or unstable</td>
                        </tr>
                        </tbody>
                    </table>
                    <br/><br/>
                    <h3 id="experimental-oses">Experimental OSes</h3>
                    <table>
                        <tbody>
                        <tr>
                            <td><img src="images/gentoo.gif" alt="Gentoo"></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>Last known working version end of 2011</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><img src="images/arch.png" alt="Arch"></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>Last known working version end of 2013</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><img src="images/opensuse.png" alt="OpenSuse"></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>Beta state, started 2014</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><img src="images/fedora.png" alt="Fedora"></td>
                            <td>&nbsp;&nbsp;</td>
                            <td>Last known working version 2012</td>
                        </tr>
                        </tbody>
                    </table>

                    <p>Feel free to ask on the mailinglist to ask for support for porting to another System.
                        Please let us know any experience if you are using one of the above listed OSs.</p>
                    <br/>
                    <h3 id="legal-comments">Legal Comments</h3>
                    <p>This site is not affiliated with or endorsed by the Fedora Project.
                        The Gentoo logo is a trademark of Gentoo Foundation Inc. and the rock-robotic framework is not part
                        of the Gentoo project, and is not and is not directed or managed by Gentoo Foundation, Inc.
                        Simliar statements are true for all listed logos and systems. The Rock-Robotic framework itself is
                        independent from the operation systems and maintained on its own.</p>
                    <br/>
                    <h3 id="status-for-other">Status for other</h3>

                    <table>
                        <tbody>
                        <tr>
                            <td>Other Linux distributions</td>
                            <td>Should work fine. No osdeps.</td>
                        </tr>
                        <tr>
                            <td>Mac OSX</td>
                            <td>Known to have problems. No osdeps.</td>
                        </tr>
                        </tbody>
                    </table>
                    <br/>
                    <h2 id="installation-the-easy-way">Installation: the easy way</h2>

                    <ol>
                        <li>
                            <p>Make sure that the Ruby interpreter is installed on your machine. Rock
                                requires ruby 1.9.2 or higher, which on Debian and Ubuntu are provided by
                                the ruby1.9.1 package.</p>

                            <pre>ruby --version</pre>
                        </li>
                        <li>Create and “cd” into the directory in which you want to install the toolchain.</li>
                        <li>
                            <p>To build the base system (base packages + toolchain, but no
                                libraries/components), use this
                                <a href="https://gitorious.org/rock/buildconf/raw/a05ea84e6cccf505554268f954bc259d30c15b99:bootstrap.sh">bootstrap.sh</a>
                                script. Save it in the folder you just created. For other options, see
                                below.</p>

                            <p><strong>There is an important note for long-term Orocos users.</strong> See the red box
                                below.</p>
                        </li>
                        <li>
                            <p>In a console, run</p>

                            <pre>sh bootstrap.sh</pre>

                            <p>If the command fails (1) report the problem / error to
                                <a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-users">the rock-users mailing
                                    list</a>,
                                (2) whatever you try to fix it, restart the bootstrapping by doing.</p>

                                <pre>rm -rf autoproj
sh bootstrap.sh</pre>
                        </li>
                        <li>Important: as the build tool tells you, you <strong>must</strong> load the generated env.sh script at the end of the build !!!
                            <ul>
                                <li>
                                    <p>source it in your current console</p>

                                    <p class="commandline">. ./env.sh</p>
                                </li>
                                <li>
                                    <p>but also add it to your .bashrc: append the following line at the end of
                                        $HOME/.bashrc</p>

                                    <p class="commandline">. /path/to/the/directory/env.sh</p>
                                </li>
                            </ul>
                        </li>
                        <li>Read the <a href="/documentation/autoproj/basic_usage.html">autoproj guide for basic usage</a> to know the
                            basic operations of the build system. More bootstrapping documentation is
                            also available <a href="/documentation/autoproj/bootstrap.html">at the same place</a></li>
                    </ol>
                    <br/>
                    <h2 id="other-bootstrapping-options">Other bootstrapping options</h2>

                    <ul>
                        <li>
                            <p><strong>to build all of Rock</strong>, use <a href="https://gitorious.org/rock/buildconf-all/raw/a6f93c3323f3956808dd35cbbf787a7ecfee1762:bootstrap.sh">this bootstrap.sh</a>
                                instead of the one listed above. ‘'’This is really meant for continuous
                                integration servers’’’. It is going to build all the packages that are
                                defined within Rock, which is probably not what you want.
                                You probably want to install the base system and then cherry-pick the packages you want. Have a look at <a href="/package_directory.html">the package
                                    directory</a> and add the package names to the
                                layout section in autoproj/manifest. For instance,  if you want to
                                get the <a href="../package_directory/packages/drivers_orogen_xsens_imu/index.html">Xsens IMU component</a>,
                                the layout section should look like:</p>

    <pre>layout:
    - rock.base
    - rock.toolchain
    - drivers/orogen/xsens_imu
</pre>
                        </li>
                    </ul>

                    <div class="note note-success">
                        <p><strong>Important for existing Orocos users</strong> The development workflow in Rock
                            currently disables the Orocos deployer and the RTT scripting language by
                            default, as they are quite expensive on the build times. Select “yes” at the
                            “compatibility with OCL” question during the build to reenable this.</p>
                    </div>
                    <br/>
                    <h2 id="maintaining-a-rock-installation">Maintaining a Rock installation</h2>

                    <p>Once Rock is installed, you can update your installation by going to the root of the
                        installation folder and do</p>

                    <pre>$ autoproj update
$ autoproj build</pre>

                    <p>You might have to reload the env.sh script after that as well, to export updated environment variables into your current shell. Simply opening a new console will do the trick (given you have added sourcing env.sh to your .bashrc).</p>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>