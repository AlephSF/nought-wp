# Aleph Nought Boilerplate

The Aleph Nought Boilerplate is an upstream repo and the source for Aleph project themes.

## Setting Up A Project

0. Create an empty repo. Set to Private, without a License.

## Setting Up Your Local Dev Environment

0. Create your project folder
0. Add `aleph-nought` as a remote repo: `git remote add nought git@github.com:AlephSF/<project-name>.git`
0. Pull from `aleph-nought`: `git pull nought main`
0. Change all `THEME_SLUG` ARG values in the Dockerfile to your project's theme name
0. Rename the theme folder in `/themes` from `aleph-nought` to your project's theme name
0. Change the `themeSlug` from `"aleph-nought"` to your project's theme name in the root package.json file
0. Commit your changes and push to your project repo: `git push origin main`
0. Install dependencies: `yarn`
0. Build the Docker environment: `yarn:build`
0. Pull down composer deps: `yarn composer:install`
0. Build the theme locally: `cd themes/<theme-slug> && yarn build`
0. Go back to project root and start the server: `yarn nds wp start`

## Converting An Existing Project

0. TBD