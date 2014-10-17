<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li><a href="index.php?page=about_rock">About Rock</a></li>
        <li class="active">Contributing</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Contributing</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">
                    <p>There are multiple ways to contribute to Rock</p>

                    <p>First and foremost, you can report bugs on the <a href="http://rock.opendfki.de">Trac
                            interface</a>, send comments and suggest enhancements
                        (both positive and negative ones) to the
                        <a href="http://lists.mech.kuleuven.be/mailman/listinfo/orocos-users">orocos-users</a>
                        and/or <a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-dev">rock-dev</a> mailing
                        lists <a href="http://rock.opendfki.de">on the Rock trac</a>.</p>

                    <p>More advanced users can contribute bugfixes and enhancements to the main Rock
                        codebase through <a href="http://gitorious.org/">the gitorious interface</a>. Clone a
                        repository, add your changes and create merge requests. Alternatively, one can
                        also improve documentation, either by creating new pages <a href="http://rock.opendfki.de">on the Rock
                            trac</a> or by cloning <a href="http://gitorious.org/rock/doc">the main Rock documentation
                            package</a> from gitorious and proposing your
                        changes through the gitorious interface.</p>

                    <p>Finally, publish your packages by <a href="../autoproj/advanced/creating_pkg_set.html">creating your own package
                            set</a> to publish your
                        libraries and components. Once you have put this package set and the code on a
                        public place (gitorious, github or even a svn-oriented code hosting), drop us a
                        line on the <a href="http://dfki.de/mailman/cgi-bin/listinfo/rock-dev" title="rock-dev">rock-dev</a> mailing list. We would be glad to include it in a (to be
                        created) third-party package directory.</p>

                    <p>Once some packages you created are of a sufficient quality, you can
                        submit them for inclusion in Rock itself. Just drop us a line on the
                        <a href="http://dfki.de/mailman/cgi-bin/listinfo/rock-dev" title="rock-dev">rock-dev</a> mailing list so that we can discuss it.</p>

                    <br/>

                    <h2 id="generating-your-own-package-directory">Generating your own package directory</h2>

                    <p>The rock-directory script base/scripts allows you to create your own package
                        directory looking like <a href="http://rock-robotics.org/package_directory.html">the one from
                            rock</a>.</p>

                    <p>To do so, run rock-directory <strong>from the autoproj installation you want to
                            document</strong>:</p>

                    <pre>rock-directory /home/mine/package_directory</pre>

                    <p>If you plan to publish this directory somewhere, we ask you to change the
                        directory template. To do so, check it out first from</p>

                    <pre>git://gitorious.org/rock/template-directory customized_template</pre>

                    <p>modify the template to match your project/institute/… name (in
                        src/default.template).</p>

                    <p>Pass the path to the template as a second argument to rock-directory</p>

                    <pre>rock-directory /home/mine/package_directory /path/to/customized_template</pre>



                </div>
            </div>



        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>