<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="index.php">Documentation</a></li>
        <li><a href="index.php?page=about_rock">About Rock</a></li>
        <li class="active">What is Rock?</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">What is Rock?</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <h2 id="overview">Overview</h2>

                    <p>Rock is a software framework for the development of robotic systems. The
                        underlying component model is based on the Orocos RTT (Real Time Toolkit). Rock
                        provides all the tools required to set up and run high-performance and reliable
                        robotic systems for wide variety of applications in research and industry. It
                        contains a rich collection of ready to use drivers and modules for use in your
                        own system, and can easily be extended by adding new components. The framework
                        was developed to specifically address the following issues in existing
                        solutions:</p>

                    <p><strong>sustainable systems</strong>. The architecture and the tools in Rock are designed
                        with long-living systems in mind. In practice, it means that for us, error
                        detection, reporting and handling is key in any robotic architecture.</p>

                    <p><strong>scalability</strong>. Provide the tools to be able to manage big systems with
                        a minimum fuss. But we don’t require you to learn about these (complex)
                        tools right away: as soon as you use rock’s component development tool,
                        oroGen, you have the guarantee that your components can be integrated
                        from simple scenarios using hardcoded C++ behaviors, to Ruby scripts up
                        to the complete system monitoring tools.</p>

                    <p><strong>reusable codebase</strong>. Even though we think that the rock toolchain
                        is one of the best out there, some other people might feel
                        differently. And they might be right. That’s why, in rock, most of
                        the functionality – from control to data display through data
                        processing – is implemented in a way that is totally independent
                        from rock’s integration framework. That’s right: just pick our
                        drivers, localization algorithms and control loops and integrate
                        them in <strong>your</strong> integration framework. You don’t have to do
                        anything on our side, as the code is completely independent from the
                        integration parts. </p>
                    <br/>
                    <h2 id="origin">Origin</h2>

                    <p>Rock has initially been developed by the <a href="http://dfki.de/robotics">DFKI
                            Robotics Innovation Center</a>. It is based on <a href="http://orocos.org">the Orocos
                            Toolchain</a>, whose primary contributor is the Katholieke Universiteit Leuven.</p>

                    <p>Website Design taken from the <a href="http://oswd.org">Open Source Web
                            Design</a> repository, originally from <a href="mailto:gw@actamail.com">G. Wolfgang</a></p>

                    <table>
                        <tbody>
                        <tr>
                            <td>HTML Validation: <a href="http://validator.w3.org/check?uri=referer" title="Validate code as W3C XHTML 1.1 Strict Compliant">W3C XHTML 1.0</a></td>
                            <td><a href="http://jigsaw.w3.org/css-validator/" title="Validate Style Sheet as W3C CSS 2.0 Compliant">W3C CSS 2.0</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>