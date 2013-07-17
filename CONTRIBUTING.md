Contributing
============

First of all: thank you! We appreciate any help you can give.

1. [Fork](https://help.github.com/articles/fork-a-repo) the repo
2. Create a topic branch - `git checkout -b my_feature`
3. Push to your branch - `git push origin my_feature`
4. Create a [Pull Request](http://help.github.com/pull-requests/) from your
   branch
5. That's it!

If you're not doing some sort of refactoring, add an entry to CHANGELOG.md
Please include these in pull requests when adding features or fixing bugs.

Oh, and 80 character columns, please!

Branches
--------

For Kohana modules the `master` branch is the latest and greatest. For any and
all Kohana versions there should be a `version/master` and `version/development`
branch, kept alive.

Unless you're only working on a particular previous version, it's suggested that
you make your pull request against the master branch by default, and backport
the fix with a second pull request where applicable.

Tests
-----

@TODO :)

We use PHPUnit for testing, you'll find a bunch of tests in `test/`.
Make sure they pass when you submit a pull request.

Please include aditional tests with your pull request if necessary.


Bugs & Feature Requests
-----------------------

You can file bugs on the issues tracker, and tag them with 'bug'.

When filing a bug, please follow these tips to help us help you:

### Good report structure

Please include the following four things in your report:

1. What you did.
2. What you expected to happen.
3. What happened instead.
4. What version/branch you're using.

The more information the better.

### Reproduction

If possible, please provide some sort of executable reproduction of the issue.
Your application has a lot of things in it, and it might be a complex
interaction between components that causes the issue.

To reproduce the issue, please make a simple example that demonstrates the
essence of the issue. If it doesn't demonstrate the issue, try including the
sources/libs your application uses (if possible), even if it doesn't seem
directly relevant.
