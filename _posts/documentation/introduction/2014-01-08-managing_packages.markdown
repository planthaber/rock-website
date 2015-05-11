---
layout: post
title:  "Managing Packages"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "managingPackages"
---
<p>There are mainly four types of packages in Rock:</p>

<ul>
  <li>plain C++ libraries, in which most of the functionality is implemented</li>
  <li>Ruby libraries</li>
  <li>vizkit widgets (or collections of)</li>
  <li>oroGen projects</li>
</ul>

<p>This page is an overview of these four types, and give pointer towards more
information about how to create and manage them</p>

<p>Naming scheme and directory structures is detailed
<a href="package_structure.html">here</a></p>

<p>In all four cases, high-level information about the package (including
dependencies w.r.t. other packages) is added to the
<a href="../autoproj/advanced/manifest-xml.html">manifest.xml</a> file in the top directory
of the package.</p>

<h2 id="plain-c-libraries">Plain C++ Libraries</h2>

<p>The C++ libraries are plain CMake packages. When developed in relation to Rock,
you are encouraged to use the <a href="cmake_macros.html">Rock CMake macros</a>.</p>

<p><strong>Note:</strong> These macros are meant as helpers for packages developed in Rock.
However:</p>

<ul class="warning">
  <li>they are simply wrappers on top of normal CMake target definitions, i.e. the
normal CMake functionality applies on the targets defined by these macros</li>
  <li>their usage is +not+ mandatory (even though it is recommended)</li>
</ul>

<p>This is not a hard requirement. Using the CMake macros and the CMake provided by
Rock only ensures that you are following the <a href="http://rock.opendfki.de/wiki/WikiStart/Standards/RG4">Rock guidelines on C++ library
packages</a></p>

<p>C++ library packages can quickly be created using <tt>rock-create-lib</tt>. See <a href="../tutorials/100_basics_create_library.html">this tutorial</a> for detailed information.</p>

<p>Information about the package (including dependencies w.r.t. other packages) is
added to the <a href="../autoproj/advanced/manifest-xml.html">manifest.xml</a> file in the
top directory of the package.</p>

<h2 id="ruby-libraries">Ruby libraries</h2>
<p>Ruby libraries follow the general structure for RubyGem packages. It is detailed
on the <a href="http://rock.opendfki.de/wiki/WikiStart/Standards/RG5">Rock guidelines on Ruby packages</a>.</p>

<p>Information about the package (including dependencies w.r.t. other packages) is
added to the <a href="../autoproj/advanced/manifest-xml.html">manifest.xml</a> file in the
top directory of the package.</p>

<h2 id="vizkit-widgets">vizkit Widgets</h2>
<p>vizkit widget packages are C++ library packages that define Qt widgets, and export
these widgets in a way that make them usable by vizkit, the Rock visualization
library. Have a look at the
<a href="../advanced_tutorials/210_data_visualization.html">tutorials</a> and the <a href="../graphical_user_interface">associated
documentation</a></p>

<h2 id="vizkit-3d-plugins">vizkit 3D Plugins</h2>
<p>vizkit 3D Plugin packages are C++ library packages that define plugins usable by
vizkit’s Vizkit3DWidget, allowing to display data in a 3D view using
OpenSceneGraph. Have a look at the
<a href="../advanced_tutorials/600_vizkit_plugin.html">tutorials</a> and the <a href="../graphical_user_interface">associated
documentation</a></p>

<h2 id="orogen-projects">oroGen projects</h2>
<p>oroGen projects are packages which contain a toplevel <tt>.orogen</tt> file
which contain description of components. See <a href="../tutorials/110_basics_create_component.html">this
tutorial</a> and <a href="../orogen">the associated documentation</a> for more
information.</p>