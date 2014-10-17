<div class="container">
    <ul class="breadcrumb">
        <li><a href="http://www.rock-robotics.org">Home</a></li>
        <li><a href="introduction/index.php">Tutorials</a></li>
        <li><a href="introduction/index.php">Basic</a></li>
        <li class="active">Viewing the Data (Live / Log Files)</li>
    </ul>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
        <?php include_once("menu.php"); ?>

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1 class="active">Viewing The Data (Live / Log Files)</h1>

            <div class="content2-container line-box">
                <div class="content2-container-1col">

                    <h2 id="abstract">Abstract</h2>
                    <p>In this tutorial you will learn how to examine your task, have a look on and log data produced by orogen tasks and finally how to replay them.</p>

                    <h2 id="task-inspector">Task Inspector</h2>
                    <p>While running a task you can examine the task with the <em>Task Inspector</em>.</p>

                    <ul>
                        <li>Open another console (don’t forget to do ‘. env.sh’ there)</li>
                        <li>Start your message_consumer script from the previous tutorial</li>
                        <li>In the other console start the task inspector with <em>rock-display message_producer</em></li>
                    </ul>

                    <p>You will see the task inspector showing the message producer task. When you click it the entry expands and shows a property section, input port section and an output port section. The output port section also shows the port called message. If clicked on an output port the data are being displayed send by the port allowing to examine them. </p>

                    <p class="align center"><img src="images/200_task_inspector.png" alt="Task Inspector"></p>

                    <p>If started without argument the task inspector shows up all running tasks after
                        some delay (to select a different Corba Name Service than the local one use the
                        option --host). A right-click on any output port or sub type allows to open available plugins able to display the selected data structure (if you wish to add your custom plugins see Writing a Vizkit Plugin).</p>
                    <br/>
                    <h2 id="logging-data">Logging Data</h2>
                    <p>By default all tasks come with a logger component that allows writing the data of the output ports to a file.</p>

                    <p><strong>Activating logging:</strong> You can activate the logging by calling the ruby
                        method <em>log_all</em> from your ruby start script. If you only want to log the
                        ports or the properties of the tasks you can also call the methods
                        <em>log_all_ports</em> or <em>log_all_configuration</em> instead.</p>

                    <div class="CodeRay">
                        <div class="code"><pre><span style="color:#036;font-weight:bold">Orocos</span>.run <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer::Task</span><span style="color:#710">"</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer</span><span style="color:#710">"</span></span>,
                        <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_consumer::Task</span><span style="color:#710">"</span></span> =&gt; <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_consumer</span><span style="color:#710">"</span></span> <span style="color:#080;font-weight:bold">do</span>
    <span style="color:#036;font-weight:bold">Orocos</span>.log_all
    producer = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_producer</span><span style="color:#710">"</span></span>
    consumer = <span style="color:#036;font-weight:bold">Orocos</span>.name_service.get <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#710">"</span><span style="color:#D20">message_consumer</span><span style="color:#710">"</span></span>

    producer.messages.connect_to consumer.messages

    producer.configure
    producer.start
    consumer.start

    <span style="color:#080;font-weight:bold">while</span> <span style="color:#069">true</span>
        sleep <span style="color:#60E">0.1</span>
    <span style="color:#080;font-weight:bold">end</span>
<span style="color:#080;font-weight:bold">end</span>
</pre></div>
                    </div>

                    <p>All the logged data go by default to log files called <em>your_task_name.x.log</em> in
                        the current working directory. In this case all the logged data go to<br>
                        message_producer.0.log. There is also a file message_consumer.0.log which
                        holds no data since the task has no output port. The digit in the end
                        increases automatically.</p>
                    <br/>
                    <h2 id="rock-replay">rock-replay</h2>
                    <p>Rock is shipped with a command line tool for displaying the content of log
                        files. Therefore, if you want to look into a log file without replaying it to
                        the framework you can call <em>rock-replay log_file.x.log</em> to get a graphical
                        overview of the logged data.  By double clicking on a port name Vizkit is
                        trying to find a widget plugin to display the data. If it cannot find one,
                        vizkit is using a generic struct viewer widget to display the content of the
                        sample (if you wish to add your custom plugins see Writing a Vizkit Plugin).
                        To display the log file recorded above call:  </p>

                    <p><em>rock-replay message_producer.0.log</em></p>

                    <p class="align center"><img src="images/200_rock_replay.png" alt="Rock Replay"></p>
                    <br/>
                    <h2 id="summary">Summary</h2>
                    <p>In this tutorial you have learned to: </p>

                    <ul>
                        <li>examine a live task with rock-display</li>
                        <li>activate logging</li>
                        <li>visualize the logged data using rock-replay</li>
                    </ul>

                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
</div>