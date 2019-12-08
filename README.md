ramverk1-module
=================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MagnusLj/ramverk1-module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MagnusLj/ramverk1-module/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/MagnusLj/ramverk1-module/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/MagnusLj/ramverk1-module/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/MagnusLj/ramverk1-module/badges/build.png?b=master)](https://scrutinizer-ci.com/g/MagnusLj/ramverk1-module/build-status/master)

[![Build Status](https://travis-ci.org/MagnusLj/ramverk1-module.svg?branch=master)](https://travis-ci.org/MagnusLj/ramverk1-module)

This is a module for Anax that provides IP and weather checking possibilities

This is how you install the module into an existing Anax installation.

Install using composer:

    composer require magnuslj/ramverk1-module

And then:

    rsync -av vendor/magnuslj/ramverk1-module/config/ config/
    rsync -av vendor/magnuslj/ramverk1-module/view/ view/

When you have done these things you can go to

    .../htdocs/ip-checker
    .../htdocs/ip-json-checker/ipJsonChecker
    .../htdocs/vader
    .../htdocs/json-vader/jsonVader

and do stuff.
