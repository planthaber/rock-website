---
layout: post
title:  "Using Rock packages outside Rock"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "managingPackages"
---
<p>As we state many times when talking about Rock, most of rock packages are meant
to be usable outside of Rock.</p>

<p>The cornerstone to that is to have separated the libraries – which are pure C++
libraries using standard tools (CMake, pkg-config) to build – from the
“integration framework”, which is oroGen in our case.</p>

<p>Anyway, this page deals with the steps needed to build CMake packages outside of
Rock, which mainly means “without using the Rock build system (autoproj)”</p>

<h2 id="preparations">Preparations</h2>
<p>Just to be one the safe side, you will need the following elements to be able to
build Rock packages:</p>

<ul>
  <li>CMake</li>
  <li>gcc / g++</li>
  <li>pkg-config</li>
</ul>

<p>Additionally, some packages will require autotools / automake to build</p>

<p>The first thing you will need to do is install the base/types package. Check it
out</p>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>git clone git://gitorious.org/rock-base/types.git
</pre></div>
</div>
</div>

<p>and install it</p>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>cd types
mkdir build
cd build
cmake -DCMAKE_INSTALL_PREFIX=$HOME/dev/install ..
make install
</pre></div>
</div>
</div>

<p class="note">The previous step will install everything but the Spline classes, which are
needed for instance by the trajectory following / motion planning components. If
you need the Spline class, install the /pkg/external/sisl/index.html package beforehand.</p>

<p>Once you have installed this package, you will also need to set a few important
environment variables:</p>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>export CMAKE_PREFIX_PATH=$HOME/dev/install
export PKG_CONFIG_PATH=$HOME/dev/install/lib/pkgconfig:$HOME/dev/install/share/pkgconfig:$HOME/dev/install/lib64/pkgconfig:$PKG_CONFIG_PATH
export LD_LIBRARY_PATH=$HOME/dev/install/lib:$HOME/dev/install/lib64:$PKG_CONFIG_PATH
export PATH=$HOME/dev/install/bin:$PATH
</pre></div>
</div>
</div>

<p>Usually, it is best practice to put this line in an env.sh line and source it
automatically in e.g. your $HOME/.bashrc:</p>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>source $HOME/dev/env.sh
</pre></div>
</div>
</div>

<h2 id="how-to-build-the-other-packages">How to build the other packages</h2>
<p>Since you are trying to build Rock packages without autoproj, you will have to
do autoproj’s job, namely:</p>

<ul>
  <li>install each package dependency (OS packages and need-to-be-built packages)</li>
  <li>configure and build each package</li>
</ul>

<p>The rest of this page will outline these steps for you</p>

<p><strong>To install the package dependencies</strong> the best way is to have a look on the
<a href="/package_directory.html">package directory</a>. The dependencies of each package
are listed there.</p>

<p><strong>To configure and build the package</strong>, the steps are essentially the same than
for base/types, namely:</p>

<ul>
  <li>checkout the package. The URL is listed in the package directory page about
the package you have to install</li>
  <li>configure it by doing the following inside the package source:</li>
</ul>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>mkdir build
cd build
cmake -DCMAKE_INSTALL_PREFIX=$HOME/dev/install ..
</pre></div>
</div>
</div>

<ul>
  <li>finally, build and install</li>
</ul>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>make install
</pre></div>
</div>
</div>