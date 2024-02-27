#!/bin/bash
# Enter your repository name
repo_name="MyCoolProject"
# Enter your GitHub username
github_username="johndoe"
# Enter your commit message
commit_message="Initial commit"
# Set up the local repository
mkdir $repo_name
cd $repo_name
git init
# Create a new file (optional)
touch README.md
echo "# Welcome to $repo_name" >> README.md
# Stage, commit, and push to GitHub
git add .
git commit -m "$commit_message"
# Create a new repository on GitHub and push changes
git remote add origin https://github.com/$github_username/$repo_name.git
git branch -M main
git push -u origin main
