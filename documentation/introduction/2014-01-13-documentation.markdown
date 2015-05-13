---
layout: post
title:  "Documentation"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "contributing"
---

<p>This page will describe how to write/modify/update documentation on this very
website. Additional, discussion-oriented, documentation is done on the <a href="http://trac.rock-robotics.org">Rock
wiki</a></p>

<p>The Rock website is automatically generated using
<a href="http://webgen.rubyforge.org">webgen</a> from <a href="http://kramdown.rubyforge.org/quickref.html">Markdown
files</a> and uploaded to
rock-robotics.org. The markdown files are stored in <a href="http://gitorious.org/rock/doc">a git repository on
gitorious</a>.</p>

<p>If you want to update the Rock reference documentation, i.e. the Rock website,
you need first to check it out. From within a Rock installation, this can be
done with</p>

<pre><code>aup base/doc
</code></pre>

<p>The documentation is flavored, i.e. there is one branch for master, one branch
for next and one branch for stable. Make sure you edit the “right” branch. The
guideline is that anything that applies to stable should be done on the stable
branch as it is what new rock users see in the first place.</p>

<p>If you need to switch the branch (as, for instance, to edit the ‘stable’
documentation even though you are using the master flavor), just do</p>

<pre><code>git checkout -b stable autobuild/stable
</code></pre>

<p>The markdown file for e.g. documentation/orogen/index.html in
src/documentation/orogen/index.page.</p>

<p>Once you have done your modifications, run webgen once to be able to preview
them:</p>

<pre><code>rake
</code></pre>

<p>This will generate the HTML code in the base/doc/out/ directory. Simply open
base/doc/out/index.html with a web browser to see the generated website. Once
you are happy with your changes, commit them to git.</p>

<p>You then will <a href="gitorious.html">propose your changes to the Rock developers</a> …
and get their thanks !</p>

<p>Finally, we are keen on improving the Rock documentation. Getting commit rights
on the Rock documentation repository is as easy as dropping an email to
the <a href="http://www.dfki.de/mailman/cgi-bin/listinfo/rock-dev">rock-dev mailing list</a>.</p>
