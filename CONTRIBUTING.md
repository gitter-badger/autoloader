# Contributing

To contribute to this project, the "fork and branch" workflow is recommended.

Go to the project's Github page and click "Fork". A copy of this repository will be added to your Github account. Clone the forked repo to your local dev machine:

    git clone https://github.com/your-username/repo-name.git

Git will automatically add a remote named "origin", so there is no need to run the `git remote add` command to define your remote repository.

To contribute to the original project, first create a feature branch in your local repository. Branches facilitate multiple contributors making changes to a project at the same time. Although you are free to name your local branches whatever you like, the GitFlow naming convention is encouraged. To create a new branch named "feature/fix-for-issue-301" and to check it out:

    git branch feature/fix-for-issue-301
    git checkout feature/fix-for-issue-301

Or more succinctly:

    git checkout -b feature/fix-for-issue-301

After making changes locally, run the following commands to stage, commit and push all changes up to the feature branch in your remote "origin" repository:

    git add .
    git commit -m "<message>"
    git push origin feature/fix-for-issue-301

Limit each branch to one specific feature or fix. Include any tests and documentation that is relevant to the work you have done.

When you have finished making your changes, you should issue a pull request to the original project repository. A pull request notifies the project maintainers, who will consider your changes and merge them into the main project. Before you do this, there are a couple of things to check.

If you have made lots of commits, you could use `git rebase` to condense your commit history before issuing the pull request. Rebasing is the process of moving a branch to a new base commit. This will make it easier for the project owners to understand what changes you've made.

It's a good idea also to synchronise your local feature branch with the original project repository, so that you've got the very latest code and to ensure that your pull request has a nice clean diff that contains only the changes related to your feature or fix. You will need to add another remote pointing back to the original repository. You can call this remote anything you like, but it is conventional to name it "upstream". When you've done that, you'll be able to pull in the latest changes from the original repo's master branch.

    git remote add upstream https://github.com/original-project/original-repo.git
    git pull upstream master

Sort out any merge conflicts and check that everything still works. Push your final changes to your own remote "origin" repository. On Github.com, navigate to your feature branch and click "Pull Request". This will notify the maintainers of the upstream repository of your changes. If your changes are approved, they will be pulled into the main project.

You don't need to keep the local version of your feature branch, since it is hosted on Github.com now, so you can go ahead and delete it.

    git checkout master
    git branch -d feature/fix-for-issue-301

And, after your pull request is approved, you can remove the feature branch from your remote repository, too.

    git push --delete origin feature/fix-for-issue-301
