# Aleph Nought Boilerplate

The Aleph Nought Boilerplate is an upstream repo and the source for Aleph project themes.

## Setting Up A Project

0. Create an empty repo. Set to Private, without a License.

## Setting Up Your Local Dev Environment

0. Clone the empty repo: `git clone git@github.com:AlephSF/<project-name>.git && cd <project-name>`
0. Add `aleph-nought` as a remote repo: `git remote add nought git@github.com:AlephSF/nought-wp.git`
0. Pull from `aleph-nought`: `git pull nought main`
0. Rename the theme folder in `/themes` from `aleph-nought` to your project's theme name
0. Change all `THEME_SLUG` ARG values in the Dockerfile to your project's theme name
0. Change the `themeSlug` from `"aleph-nought"` to your project's theme name in the root package.json file
0. Commit your changes and push to your project repo: `git push origin main` - some repos may still use `master`
0. Install dependencies: `yarn`
0. Build the Docker environment: `yarn build`
0. Install theme dependencies: `cd themes/<theme-slug> && yarn`
0. Pull down composer deps: `composer install`
0. Build the theme locally: `yarn build`
0. Go back to project root and start the server: `yarn nds wp start`
0. Install WordPress at [localhost:8080](http://localhost:8080)

## Converting An Existing Project

0. TBD