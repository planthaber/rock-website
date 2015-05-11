---
layout: post
title:  "Release Strategy"
smallDescription: "Agenda corp1."
imgSrc: "assets/frontend/pages/img/works/img1.jpg"
date:   2014-11-22 23:08:05
categories: introduction
group: "aboutRock"
---
                  
Rock does <strong>not</strong> have fixed-point release.

Rock is maintained on a rolling-release basis. Each package provides three
branches or ‘flavors’


* the ‘master’ branch on which the development is made
* the ‘next’ branch on which changes are applied from ‘master’ to make sure
everything works fine before …
* .. the ‘stable’ branch is updated from ‘next’

More specifically, the whole process works on the basis of the following cycle:

1. ‘next’ gets open for updates during a week. After this week, the only changes
that can be pushed to ‘next’ are bugfixes and documentation updates.
Developers are required to publicize any API-breaking changes on the rock-dev
mailing list BEFORE this merge window.
2. when ‘next’ is ready, i.e. if no known critical bug exists on next <em>after</em>
at least a 3-week period, changes on ‘next’ are pushed to ‘stable’ and ‘next’
gets open for new updates.
3. LOOP 1

This strategy will be the main release mechanism for Rock. There <strong>will</strong> be
some exceptions, when some in-depth changes require to change a lot of packages
at the same time.

In this case, the changes will be made on a separate branch (‘topic branch’),
and tested. Once they are deemed of a good-enough quality, they will be
first publicized to rock-dev and then merged into master (and, later on, to next
and finally to stable).

Since they are pervasive changes, it is important for us that people can prepare
themselves by branching or by avoiding updates for a while, i.e. that they can’t
break existing systems unknowingly.



              
