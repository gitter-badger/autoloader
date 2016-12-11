
# Contributing

To contribute to this project, the "fork and branch" workflow is recommended.


**Step 1: Fork the upstream repository**

Go to this project's GitHub page and click "Fork". A clone of this project's repository will be added to your GitHub account.

The original repository is referred to as the "upstream" repository, while your clone is referred to as the "origin" repository.


**Step 2: Clone the origin repository**

    git clone https://github.com/your-username/repo-name.git

This command creates a clone of your origin repository on your local development machine. This is referred to as the "local" repository.

When you run the `clone` command, git will automatically add a remote named "origin", which you will push back to when you've made your changes locally (`fir push origin <branch>`).


**Step 3: Make your changes**

Create a feature branch in your local repository. The [GitFlow](http://nvie.com/posts/a-successful-git-branching-model/) naming convention is recommended.

    git branch feature/fix-for-issue-301
    git checkout feature/fix-for-issue-301

Or more succinctly:

    git checkout -b feature/fix-for-issue-301

After making your changes locally, run the following commands to stage, commit and push all changes up to the feature branch in your remote origin repository.

    git add .
    git commit -m "<message>"
    git push origin feature/fix-for-issue-301

Include any tests and documentation that is relevant to the work you have done. When you are ready to make a pull request from your feature branch, your feature branch ought to be in a deployable state.

Don't build a cathedral in a feature branch. Try to limit changes in each feature branch to one very specific feature or fix. Pull requests for small, incremental improvements will get reviewed faster and will be easier to pull into the original project.

In the rare instances when large features need to be developed over many months, it is important to have a meaningful commit history. Each commit, as much as possible, should be a single logical change. Commit titles should be less than 80 characters in length but may be accompanied by longer descriptions where necessary. Commiting your work in a series of discrete stages is a powerful way to express the evolution of a complex feature idea. Be sure to pull in changes from the upstream master branches at regular intervals so that your feature branch has the smallest possible diff.

**Step 4: Prepare a pull request**

The next step is to issue a pull request to the maintainers of the original project repository. Before you do that, there are a few things to consider.

If you have made lots of commits, you might want to use `git rebase` to condense your commit history before issuing a pull request. This will make it easier for the main project owners to understand what changes you've made.

If you have spent a lot of time working on your new feature, you should synchronise your local feature branch with the original project repository, so that you've got the very latest code and to ensure that your pull request has a nice clean diff that contains only _your_ changes. To do this, you will need to add another remote pointing back to the original repository. You can call this remote anything you like, but it is conventional to name it "upstream". When you've done that, you'll be able to pull in the latest commits to the upstream repository's master branch.

    git remote add upstream https://github.com/original-project/original-repo.git
    git pull upstream master

Sort out any merge conflicts and check that everything still works. Push your final changes to your own remote "origin" repository.


**Step 5: Issue a pull request**

A pull request notifies the maintainers of the upstream repository, who will review your changes and, if the changes are approved, merge them into the main project.

On GitHub, navigate to your feature branch and click "Pull Request". Follow the instructions to complete your pull request.


**Step 6: Tidy up**

You don't need to keep the local version of your feature branch, since it is hosted on GitHub now, so you can go ahead and delete it.

    git checkout master
    git branch -d feature/fix-for-issue-301

After your pull request is approved, you can remove the feature branch from your remote repository, too.

    git push --delete origin feature/fix-for-issue-301

