<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li><a href="index.php?page=about_rock">About Rock</a></li>
        <li class="active">Release Strategy</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Release Strategy</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">
                    <p>Rock does <strong>not</strong> have fixed-point release.</p>

                    <p>Rock is maintained on a rolling-release basis. Each package provides three
                        branches or ‘flavors’</p>

                    <ul>
                        <li>the ‘master’ branch on which the development is made</li>
                        <li>the ‘next’ branch on which changes are applied from ‘master’ to make sure
                            everything works fine before …</li>
                        <li>.. the ‘stable’ branch is updated from ‘next’</li>
                    </ul>

                    <p>More specifically, the whole process works on the basis of the following cycle:</p>

                    <ol>
                        <li>‘next’ gets open for updates during a week. After this week, the only changes
                            that can be pushed to ‘next’ are bugfixes and documentation updates.
                            Developers are required to publicize any API-breaking changes on the rock-dev
                            mailing list BEFORE this merge window.</li>
                        <li>when ‘next’ is ready, i.e. if no known critical bug exists on next <em>after</em>
                            at least a 3-week period, changes on ‘next’ are pushed to ‘stable’ and ‘next’
                            gets open for new updates.</li>
                        <li>LOOP 1</li>
                    </ol>

                    <p>This strategy will be the main release mechanism for Rock. There <strong>will</strong> be
                        some exceptions, when some in-depth changes require to change a lot of packages
                        at the same time.</p>

                    <p>In this case, the changes will be made on a separate branch (‘topic branch’),
                        and tested. Once they are deemed of a good-enough quality, they will be
                        first publicized to rock-dev and then merged into master (and, later on, to next
                        and finally to stable).</p>

                    <p>Since they are pervasive changes, it is important for us that people can prepare
                        themselves by branching or by avoiding updates for a while, i.e. that they can’t
                        break existing systems unknowingly.</p>

                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>