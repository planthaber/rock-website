---
layout: post
title:  "Package Structure"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "managingPackages"
---
<p class="note">Below, oroGen refers to the tool that is used in Rock to develop components</p>

<h2 id="categories">Categories</h2>
<p>The Rock packages are split into 6 main categories</p>

<ul>
  <li><strong>base</strong> base types, CMake script repositories, …</li>
  <li><strong>drivers</strong> packages that are related to device drivers: drivers themselves,
and common libraries that ease their development</li>
  <li><strong>slam</strong> packages that are related to localization and mapping both separately
and as SLAM</li>
  <li><strong>control</strong> packages that are related to motion control</li>
  <li><strong>planning</strong> packages that are related to path and task planning</li>
  <li><strong>toolchain</strong> packages that are related to the toolchain</li>
  <li><strong>image_processing</strong> packages that are related to image processing</li>
</ul>

<p>On gitorious, each category has its own project, called rock-NAME (for instance,
rock-drivers for the drivers).</p>

<p>When installed, packages go into folders that correspond to their main category.
Moreover, the oroGen-independent packages are installed directly under that
folder, while the oroGen components are installed in an ‘orogen’ subfolder.</p>

<p>For instance, the driver libraries are stored in drivers/ and the driver oroGen
components in drivers/orogen/</p>

<ul>
  <li>no other subdirectories other than “orogen” can be created under the main
categories</li>
  <li>opening new categories is indeed possible but <strong>must</strong> be discussed first on
the mailing list.</li>
</ul>

<h2 id="naming">Naming</h2>

<ul>
  <li>snake_case for all path components (categories and package names)</li>
</ul>

<h2 id="libraries-and-orogen-components">Libraries and oroGen components</h2>
<p>The most important design factor in the Rock package structure is that
functionality should be implemented in a way that is <strong>independent from any
integration framework</strong></p>

<p>In practice, it means that for most functionality, there will be two Rock
packages:</p>

<ul>
  <li>the “library” part which usually is a C++ library, that uses CMake to build,
with maybe some dependencies on other C++ libraries (other Rock libraries
and/or “common” libraries)</li>
  <li>the “orogen” part which is providing an integrated oroGen component for the
libraries.</li>
</ul>

<p>For instance, in the <a href="http://gitorious.org/rock-drivers">rock-drivers</a>
subproject, there is <a href="http://gitorious.org/rock-drivers/hokuyo">the Hokuyo driver
library</a> and the corresponding <a href="http://gitorious.org/rock-drivers/orogen-hokuyo">oroGen
component</a>.</p>

<h2 id="mapping-between-local-installation-and-gitorious-repositories">Mapping between local installation and gitorious repositories</h2>

<p>A library (non-oroGen package) installed on the local system as</p>

<pre><code>category/package_name
</code></pre>

<p>will be managed in a gitorious repository called</p>

<pre><code>http://gitorious.org/rock-category/package_name
</code></pre>

<p class="warning"><strong>Exception</strong> the toolchain packages are installed in tools/ but are managed in
the rock-toolchain project</p>

<p>An oroGen package installed on the local system as</p>

<pre><code>category/orogen/package_name
</code></pre>

<p>will be managed in a gitorious repository called</p>

<pre><code>http://gitorious.org/rock-category/orogen-package_name
</code></pre>

<p>When a one-to-one mapping exists between a library and an oroGen package (e.g.
the hokuyo driver library and the hokuyo oroGen component), both will have the
same “package_name”. For instance, when installed</p>

<pre><code>drivers/hokuyo
drivers/orogen/hokuyo
</code></pre>

<p>and on gitorious:</p>

<pre><code>http://gitorious.org/rock-drivers/hokuyo
http://gitorious.org/rock-drivers/orogen-hokuyo
</code></pre>
