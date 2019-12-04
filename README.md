#This is a module that provides IP and weather checking possibilities

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
