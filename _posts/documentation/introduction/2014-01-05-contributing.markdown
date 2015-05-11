---
layout: post
title:  "Contributing"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "aboutRock"
---

There are multiple ways to contribute to Rock

First and foremost, you can report bugs on the <a href="http://rock.opendfki.de">Trac
interface</a>, send comments and suggest enhancements (both positive and negative ones) to the
<a href="http://lists.mech.kuleuven.be/mailman/listinfo/orocos-users">orocos-users</a>
and/or <a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-dev">rock-dev</a> mailing
lists <a href="http://rock.opendfki.de">on the Rock trac</a>.

More advanced users can contribute bugfixes and enhancements to the main Rock
codebase through <a href="http://gitorious.org/">the gitorious interface</a>. Clone a
repository, add your changes and create merge requests. Alternatively, one can
also improve documentation, either by creating new pages <a href="http://rock.opendfki.de">on the Rock
trac</a> or by cloning <a href="http://gitorious.org/rock/doc">the main Rock documentation
package</a> from gitorious and proposing your
changes through the gitorious interface.

Finally, publish your packages by <a href="../autoproj/advanced/creating_pkg_set.html">creating your own package
set</a> to publish your libraries and components. Once you have put this package set and the code on a
public place (gitorious, github or even a svn-oriented code hosting), drop us a
line on the <a href="http://dfki.de/mailman/cgi-bin/listinfo/rock-dev" title="rock-dev">rock-dev</a> mailing list.
We would be glad to include it in a (to be created) third-party package directory.

Once some packages you created are of a sufficient quality, you can submit them for inclusion in Rock itself.
Just drop us a line on the <a href="http://dfki.de/mailman/cgi-bin/listinfo/rock-dev" title="rock-dev">rock-dev</a>
mailing list so that we can discuss it.

<h2 id="generating-your-own-package-directory">Generating your own package directory</h2>

The rock-directory script base/scripts allows you to create your own package
directory looking like <a href="http://rock-robotics.org/package_directory.html">the one from
rock</a>.

To do so, run rock-directory <strong>from the autoproj installation you want to
document</strong>:

<pre>rock-directory /home/mine/package_directory</pre>

If you plan to publish this directory somewhere, we ask you to change the
directory template. To do so, check it out first from

<pre>git://gitorious.org/rock/template-directory customized_template</pre>

modify the template to match your project/institute/… name (in src/default.template).

Pass the path to the template as a second argument to rock-directory

<pre>rock-directory /home/mine/package_directory /path/to/customized_template</pre>