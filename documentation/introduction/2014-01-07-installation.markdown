---
layout: post
title:  "Installation"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "installation"
---
                  
This page explains how to install Rock and where to look for more information (tutorials, …).

## Level of support
This section lists the operating systems where Rock is <em>well tested</em>, is <em>untested</em> and where the status is <em>unknown</em>.
For <em>well tested</em> operating systems, a build server makes sure that Rock builds
fine, and it is known to be actively used. <em>Untested</em> operating systems have
had users (so, it did work at some point), but it is unknown whether it is
still being actively used. Finally, <em>unknown status</em> operating systems are OSs where
Rock should work, but we have had no known report of its success or failure.

### Well tested OSs

<table>
  <tbody>
    <tr>
      <td><img src="/images/ubuntu.png" alt="Ubuntu"></td>
      <td>Latest LTS and later (currently anything newer than 12.04). We let 6 months after a LTS release before deprecating the previous LTS.</td>
    </tr>
    <tr>
      <td><img src="images/debian.png" alt="Debian"></td>
      <td>testing or unstable</td>
    </tr>
  </tbody>
</table>

### Experimental OSes

<table>
  <tbody>
    <tr>
      <td><img src="/images/gentoo.gif" alt="Gentoo"></td>
      <td>Last known working version end of 2011</td>
    </tr>
    <tr>
      <td><img src="/images/arch.png" alt="Arch"></td>
      <td>Last known working version end of 2013</td>
    </tr>
    <tr>
      <td><img src="/images/opensuse.png" alt="OpenSuse"></td>
      <td>Beta state, started 2014</td>
    </tr>
    <tr>
      <td><img src="/images/fedora.png" alt="Fedora"></td>
      <td>Last known working version 2012</td>
    </tr>
  </tbody>
</table>

Feel free to ask on the mailinglist to ask for support for porting to another System.
Please let us know any experience if you are using one of the above listed OSs.

#### Legal Comments
This site is not affiliated with or endorsed by the Fedora Project.
The Gentoo logo is a trademark of Gentoo Foundation Inc. and the rock-robotic framework is not part
of the Gentoo project, and is not and is not directed or managed by Gentoo Foundation, Inc. 
Simliar statements are true for all listed logos and systems. The Rock-Robotic framework itself is 
independent from the operation systems and maintained on its own.

### Status for other

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

## Installation: the easy way

1. Make sure that the Ruby interpreter is installed on your machine. Rock
requires ruby 1.9.2 or higher, which on Debian and Ubuntu are provided by
the ruby1.9.1 package.
    <pre>ruby --version </pre>

2. Create and “cd” into the directory in which you want to install the toolchain.

3. To build the base system (base packages + toolchain, but no libraries/components), use this
<a href="https://gitorious.org/rock/buildconf/raw/a05ea84e6cccf505554268f954bc259d30c15b99:bootstrap.sh">bootstrap.sh</a>
script. Save it in the folder you just created. For other options, see below.
    <strong>There is an important note for long-term Orocos users.</strong> See the red box below.

4. In a console, run
    <pre>sh bootstrap.sh </pre>
    If the command fails (1) report the problem / error to
<a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-users">the rock-users mailing list</a>,
(2) whatever you try to fix it, restart the bootstrapping by doing.
    <pre>rm -rf autoproj sh bootstrap.sh </pre>

5. Important: as the build tool tells you, you <strong>must</strong> load the generated env.sh script at the end of the build !!!
* source it in your current console <p class="commandline">. ./env.sh
* but also add it to your .bashrc: append the following line at the end of$HOME/.bashrc

        <p class="commandline">. /path/to/the/directory/env.sh


6. Read the <a href="/documentation/autoproj/basic_usage.html">autoproj guide for basic usage</a> to know the
basic operations of the build system. More bootstrapping documentation is
also available <a href="/documentation/autoproj/bootstrap.html">at the same place</a>

## Other bootstrapping options

<ul>
  <li>
    <strong>to build all of Rock</strong>, use <a href="https://gitorious.org/rock/buildconf-all/raw/a6f93c3323f3956808dd35cbbf787a7ecfee1762:bootstrap.sh">this bootstrap.sh</a>
instead of the one listed above. ‘'’This is really meant for continuous
integration servers’’’. It is going to build all the packages that are
defined within Rock, which is probably not what you want.
You probably want to install the base system and then cherry-pick the packages you want. Have a look at <a href="/package_directory.html">the package
directory</a> and add the package names to the
layout section in autoproj/manifest. For instance,  if you want to
get the <a href="http://rock-robotics.org/package_directory/packages/drivers_orogen_xsens_imu/index.html">Xsens IMU component</a>,
the layout section should look like:

    <pre>layout:
   - rock.base
   - rock.toolchain
   - drivers/orogen/xsens_imu
</pre>
  </li>
</ul>

<div class="warning">
  <strong>Important for existing Orocos users</strong> The development workflow in Rock
currently disables the Orocos deployer and the RTT scripting language by
default, as they are quite expensive on the build times. Select “yes” at the
“compatibility with OCL” question during the build to reenable this.
</div>

## Maintaining a Rock installation

Once Rock is installed, you can update your installation by going to the root of the
installation folder and do

<p class="commandline">autoproj update <br> autoproj build

You might have to reload the env.sh script after that as well, to export updated environment variables into your current shell. Simply opening a new console will do the trick (given you have added sourcing env.sh to your .bashrc).