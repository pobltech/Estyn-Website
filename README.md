<p align="center">
  Estyn site.<br/>
  <br/>
  Bedrock + Sage theme + Pobl Tech Blocks plugin (+ dev source/environment for the blocks development)
  <br/>
  <strong>Requires PHP 8.2</strong>
  <ul>
    <li>Set up your SQL database and user</li>
    <li>Import a copy of the database if needed</li>
    <li>Make sure to change site URL and wp home to whatever you're going to use</li>
    <li>In the root directory:
      <ul>
        <li>Add and populate .env file ( https://roots.io/bedrock/docs/environment-variables/ )</li>
        <li>composer install</li>
        <li>Start your PHP server</li>
      </ul>
    </li>
    <li>In theme directory: 
      <ul>
        <li>composer install</li>
        <li>yarn</li>
        <li>yarn build</li>
        <li>DON'T do yarn dev yet because you probably need to make changes to bud.config.js (which you shouldn't do in the main branch, so we'll come back to this</li>
      </ul>
    </li>
    <li>In plugins/pobl-tech-blocks/ directory:
      <ul>
        <li>npm install (necessary to install "wp-scripts" package/command)</li>
        <li>npm run build:cta-block</li>
        <li>npm run build:carousel-block</li>
        <li>npm run build:accordion-block</li>
        <li>npm run build:accordion-item-block</li>
        <li>("npm run build" might also work, in which case all the blocks get built)</li>
      </ul>
    </li>
    <li>Visit the URL of you local server and check the site is working. If all good, continue...</li>
    <li>Create your own branch and switch to it</li>
    <li>In theme directory:
      <ul>
        <li>Edit bud.config.js and change the PROXY URL to your local server URL</li>
        <li>yarn dev</li>
      </ul>
    </li>
    <li>If you are making changes to the blocks code, in the plugins/pobl-tech-blocks/ directory:
      <ul>
        <li>npm run start:cta-block (or whichever block you're working on) and it'll continually monitor changes and build automatically (just like yarn dev). "npm run start" might also work, in which case all the blocks get monitored/built</li>
      </ul>
    </li>        
    <li>ALSO, useful: To clear cache (application, view and config), from the root directory:
      <ul>
        <li>Install the WordPress CLI ( brew install wp-cli )</li>
        <li>wp acorn cache:clear</li>
        <li>wp acorn view:clear</li>
        <li>wp acorn config:clear</li>
      </ul>
    </li>
    <li>Also: You might want to download a copy of the uploaded images/files and put them in the uploads folder</li>
  </ul>
</a>

<p align="center">
  <a href="https://roots.io/bedrock/">
    <img alt="Bedrock" src="https://cdn.roots.io/app/uploads/logo-bedrock.svg" height="100">
  </a>
</p>

<p align="center">
  <a href="https://packagist.org/packages/roots/bedrock">
    <img alt="Packagist Installs" src="https://img.shields.io/packagist/dt/roots/bedrock?label=projects%20created&colorB=2b3072&colorA=525ddc&style=flat-square">
  </a>

  <a href="https://packagist.org/packages/roots/wordpress">
    <img alt="roots/wordpress Packagist Downloads" src="https://img.shields.io/packagist/dt/roots/wordpress?label=roots%2Fwordpress%20downloads&logo=roots&logoColor=white&colorB=2b3072&colorA=525ddc&style=flat-square">
  </a>
  
  <img src="https://img.shields.io/badge/dynamic/json.svg?url=https://raw.githubusercontent.com/roots/bedrock/master/composer.json&label=wordpress&logo=roots&logoColor=white&query=$.require[%22roots/wordpress%22]&colorB=2b3072&colorA=525ddc&style=flat-square">

  <a href="https://github.com/roots/bedrock/actions/workflows/ci.yml">
    <img alt="Build Status" src="https://img.shields.io/github/actions/workflow/status/roots/bedrock/ci.yml?branch=master&logo=github&label=CI&style=flat-square">
  </a>

  <a href="https://twitter.com/rootswp">
    <img alt="Follow Roots" src="https://img.shields.io/badge/follow%20@rootswp-1da1f2?logo=twitter&logoColor=ffffff&message=&style=flat-square">
  </a>
</p>

<p align="center">WordPress boilerplate with Composer, easier configuration, and an improved folder structure</p>

<p align="center">
  <a href="https://roots.io/bedrock/">Website</a> &nbsp;&nbsp; <a href="https://roots.io/bedrock/docs/installation/">Documentation</a> &nbsp;&nbsp; <a href="https://github.com/roots/bedrock/releases">Releases</a> &nbsp;&nbsp; <a href="https://discourse.roots.io/">Community</a>
</p>

## Sponsors

Bedrock is an open source project and completely free to use. If you've benefited from our projects and would like to support our future endeavors, please consider [sponsoring Roots](https://github.com/sponsors/roots).

<div align="center">
<a href="https://k-m.com/"><img src="https://cdn.roots.io/app/uploads/km-digital.svg" alt="KM Digital" width="120" height="90"></a> <a href="https://carrot.com/"><img src="https://cdn.roots.io/app/uploads/carrot.svg" alt="Carrot" width="120" height="90"></a> <a href="https://wordpress.com/"><img src="https://cdn.roots.io/app/uploads/wordpress.svg" alt="WordPress.com" width="120" height="90"></a> <a href="https://worksitesafety.ca/careers/"><img src="https://cdn.roots.io/app/uploads/worksite-safety.svg" alt="Worksite Safety" width="120" height="90"></a> <a href="https://www.copiadigital.com/"><img src="https://cdn.roots.io/app/uploads/copia-digital.svg" alt="Copia Digital" width="120" height="90"></a> <a href="https://www.freave.com/"><img src="https://cdn.roots.io/app/uploads/freave.svg" alt="Freave" width="120" height="90"></a>
</div>

## Overview

Bedrock is a WordPress boilerplate for developers that want to manage their projects with Git and Composer. Much of the philosophy behind Bedrock is inspired by the [Twelve-Factor App](http://12factor.net/) methodology, including the [WordPress specific version](https://roots.io/twelve-factor-wordpress/).

- Better folder structure
- Dependency management with [Composer](https://getcomposer.org)
- Easy WordPress configuration with environment specific files
- Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
- Autoloader for mu-plugins (use regular plugins as mu-plugins)
- Enhanced security (separated web root and secure passwords with [wp-password-bcrypt](https://github.com/roots/wp-password-bcrypt))

## Getting Started

See the [Bedrock installation documentation](https://roots.io/bedrock/docs/installation/).

## Stay Connected

- Join us on Discord by [sponsoring us on GitHub](https://github.com/sponsors/roots)
- Participate on [Roots Discourse](https://discourse.roots.io/)
- Follow [@rootswp on Twitter](https://twitter.com/rootswp)
- Read the [Roots Blog](https://roots.io/blog/)
- Subscribe to the [Roots Newsletter](https://roots.io/newsletter/)
