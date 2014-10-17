<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li><a href="index.php?page=contributing2">Contributing</a></li>
        <li class="active">Packages</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">

            <h1 class="active">Packages</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <p>There are two options for you To contribute packages to Rock:</p>

                    <ul>
                        <li>make your package a part of Rock ‘proper’, i.e. of the Rock package set</li>
                        <li>create <a href="../autoproj/advanced/creating_pkg_set.html">your own package set</a></li>
                    </ul>

                    <p>This page will describe the process for both options.</p>

                    <h2 id="add-your-package-to-rock">Add your package to Rock</h2>

                    <p>As a side note, it is important that you realize that your library can be
                        integrated <em>without any changes</em> to Rock. The Rock build system is designed for
                        that, as long as it follows widely-accepted standards (see for instance
                        the “Build System Behaviour” section of the <a href="http://rock.opendfki.de/wiki/WikiStart/Standards/RG4">corresponding Rock
                            guidelines</a>. Even the
                        manifest.xml file, which is used to describe the package, <a href="../autoproj/advanced/manifest.xml#package_set">can be provided as
                            part of the package set</a> instead
                        of as part of the package itself.</p>

                    <p>The process to get a package in Rock is:</p>

                    <ul>
                        <li>locally modify the rock package set (in autoproj/remotes/rock) to define your
                            package. The package should go in the libs.autobuild file if it is a library
                            and in the orogen.autobuild file if it is an oroGen package.</li>
                        <li>commit these changes</li>
                        <li><a href="gitorious.html">send these changes to the Rock developers</a>. Make sure that
                            the purpose of the package(s) is clear.</li>
                        <li>at this point, there is the option of putting the source code within Rock’s
                            gitorious projects. While it is not mandatory, it is the preferred option.
                            The Rock developers will be in touch with you to discuss this (either through
                            the <a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-users">rock-users mailing list</a> or through the merge request / ticket you created)</li>
                    </ul>
                    <br/>
                    <h2 id="publish-your-package-set-in-rock">Publish your package set in Rock</h2>

                    <p>If you have integrated more than one package, and want to keep control over
                        these packages (i.e. want them to appear to be a separate contribution from your
                        company / research institute), there is the possibility to submit a package set.
                        This package set will be added to Rock’s default build configuration, and will
                        be integrated in the Rock package directory.</p>

                    <p>The process to submit a package set is:</p>

                    <ul>
                        <li>send the link and description of the package set to <a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-users">rock-users mailing
                                list</a></li>
                        <li>wait for a Rock developer to pick up on that</li>
                    </ul>



                </div>
            </div>


        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>