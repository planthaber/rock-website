---
layout: post
title:  "Sending Changes"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "contributing"
---
<h2 id="abstract">Abstract</h2>
<p>This page covers how to send modifications to code and documentation to the Rock
developers, assuming that you did not get a direct commit access to the
packages you modify.</p>

<p>The Rock repositories have been moved from gitorious to github - they can now be
found here: <a href="https://github.com/rock-core">https://github.com/rock-core</a>.</p>

<p>The other pages in this Contributing section cover the other aspects: how the
documentation is done, how to create new packages, …</p>

<p>The main part of this page will deal with how to use github to submit changes
to the Rock codebase and documentation.</p>

<p>This tutorial will teach you how to:</p>

<ul>
  <li>Create your own working copy of a Rock repository,</li>
  <li>configure your Rock installation accordingly and</li>
  <li>create pull requests.</li>
</ul>

<h2 id="create-your-own-working-copy">Create your own working copy</h2>
<p>To create your own working copy of one of the Rock repositories, fork the
<em>rock-core</em> repository - this is done as follows:</p>

<p>Go to the <em>rock-core</em> repository on github - for example
<a href="https://github.com/rock-core/gui-vizkit3d">https://github.com/rock-core/gui-vizkit3d</a>. Click “fork” to create your own
working copy of the repository - the corresponding URL will be
<em>https://github.com/your_name/gui-vizkit3d</em>.</p>

<h2 id="configure-your-rock-installation">Configure your Rock installation</h2>
<p>As you are now working on your own forked version of the <em>rock-core</em> repository,
you need to configure your Rock installation accordingly.</p>

<p>First “cd” into your repository and add a new remote:</p>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>git remote add your_name https://github.com/your_name/your_repository.git
</pre></div>
</div>
</div>

<p>Then, “cd” into your <em>dev/autoproj/</em> folder and update the file <em>overrides.yml</em>
as follows:</p>

<div class="highlighter-coderay"><div class="CodeRay">
  <div class="code"><pre>  - <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">your_repository:</span></span>
    <span style="color:#606">branch</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">master</span></span>
    <span style="color:#606">url</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">git@github.com:your_name/your_repository.git</span></span>
    <span style="color:#606">push_to</span>: <span style="background-color:hsla(0,100%,50%,0.05)"><span style="color:#D20">git@github.com:your_name/your_repository.git</span></span>
</pre></div>
</div>
</div>

<p>From now on, changes you make to your repository are pushed to the respective
branch of your forked repository.</p>

<h2 id="create-pull-requests">Create pull requests</h2>
<p>Once you have changed some of the code, tested the result and want to commit
your changes to the corresponding <em>rock-core</em> repository, you need to create
a pull request. The standard procedure is as follows:</p>

<ul>
  <li>Go to your forked repository on github.</li>
  <li>Click <em>Pull Requests</em>.</li>
  <li>Click <em>New pull request</em>.</li>
  <li>You will now see see the changes you committed to your forked repository and
which are not yet in the corresponding <em>rock-core</em> repository.</li>
  <li>Click <em>Create pull request</em>.</li>
  <li>You should give your pull request a meaningful name and enter a comment,
so that the people checking your pull request easily understand what changes
you made.</li>
  <li>Click <em>Create pull request</em>. A mail will be sent out to notify the
core developers. Any comments on the request will alert you back via e-mail
as well.</li>
</ul>