
# Contributing

Nirvarnia is a set of PHP packages to help you make websites, web applications and RESTful APIs. It is a free and open source project made possible by generous contributions from expert software engineers like you. There are three ways that you can contribute:

* Report bugs
* Suggest features
* Make enhancements


## Report bugs

Before reporting a bug, please check that it has not been fixed already. Download the latest stable build from the package's "master" branch and try to reproduce the error. Also review the package's issue tracker to check that the bug has not been reported previously.

Bug reports may be submitted to the issue tracker for the relevant Nirvarnia package. From the package's [GitHub repository](https://github.com/nirvarnia), navigate to the "Issues" section and then press the "New issue" button.

Follow these guidelines when reporting a new issue:

* Provide clear step-by-step instructions to reproduce the issue.
* State the expected behaviour and the actual behaviour.
* Describe the host environment in which you encountered the error: operating system, PHP version, browser, URL, etc.
* Include a reduced test case that fails, or link to a live example, if possible.
* Collect and attach any relevant logs.
* Provide screenshots or a video, if applicable.
* File one issue at a time.

Please do not use the issue trackers for support requests. There are [better channels](support.md) for those.


## Suggest features

Ideas for new features may be emailed directly to Nirvarnia's lead developer at [hello@kieranpotts.com](mailto:hello@kieranpotts.com).

Take a moment to consider if your idea fits with the scope and aims of the Nirvarnia project. Take your time to develop a strong case for the feature, providing as much detail and context as possible.


## Make enhancements

To contribute source code, the "fork and branch" workflow is recommended.


### Step 1: Fork the upstream repository

Go to this project's GitHub page and click "Fork". A clone of this project's repository will be added to your GitHub account.

The original repository is referred to as the "upstream" repository, while your clone is referred to as the "origin" repository.


### Step 2: Clone the origin repository

```bash
git clone https://github.com/your-username/repo-name.git
```

This command creates a clone of your origin repository on your local development machine. This is referred to as the "local" repository.

When you run the ``clone`` command, git will automatically add a remote named "origin", which you will push back to when you've made your changes locally (``git push origin <branch>``).


### Step 3: Make your changes

Create a feature branch in your local repository. The [GitFlow](http://nvie.com/posts/a-successful-git-branching-model/) naming convention is recommended.

```bash
git branch feature/fix-for-issue-301
git checkout feature/fix-for-issue-301
```

Or more succinctly:

```bash
git checkout -b feature/fix-for-issue-301
```

After making your changes locally, run the following commands to stage, commit and push all changes up to the feature branch in your remote origin repository.

```bash
git add .
git commit -m "<message>"
git push origin feature/fix-for-issue-301
```

Include any tests and documentation that is relevant to the work you have done. When you are ready to make a pull request from your feature branch, your feature branch ought to be in a deployable state.

Don't build a cathedral in a feature branch. Try to limit changes in each feature branch to one very specific feature or fix. Pull requests for small, incremental improvements will get reviewed faster and will be easier to pull into the original project.

If you are working on a big update that touches lots of modules, it is important to have a meaningful commit history. Each commit, as much as possible, should be a single logical change. Commit titles should be less than 80 characters in length but may be accompanied by longer descriptions where necessary. Commiting your work in a series of discrete stages is a powerful way to express the evolution of a complex feature idea.

Be sure to pull in changes from the upstream master branch at regular intervals. This will ensure that you have got the very latest code and, when it is time to issue your pull request, your feature branch will have the smallest possible diff that contains only _your_ changes. To do this, you will need to add another remote pointing back to the upstream repository.

```bash
git remote add upstream https://github.com/original-project/upstream-repo.git
git pull upstream master
```


### Step 4: Issue a pull request

A pull request notifies the maintainers of the upstream repository, who will review your changes and, if the changes are approved, merge them into the main upstream project.

On GitHub, navigate to your feature branch and click "Pull Request". Follow the instructions to complete the pull request.


### Step 5: Tidy up

You don't need to keep the local version of your feature branch, since it is hosted on GitHub.

```bash
git checkout master
git branch -d feature/fix-for-issue-301
```

After your pull request is approved, you can remove the feature branch from your remote repository, too.

```bash
git push --delete origin feature/fix-for-issue-301
```

