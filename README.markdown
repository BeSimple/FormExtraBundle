## Information

FormExtraBundle offer new validator constraints for your Symfony2 project.

This repository hosts FormExtraBundle that do not belong to the core of Symfony2 but can
be nonetheless interesting to share with other developers.

Fork this repository, add your extension, and request a pull.

## Installation

### Add FormExtraBundle to your src/BeSimple directory

    git submodule add git://github.com/francisbesset/FormExtraBundle.git src/BeSimple/FormExtraBundle

### Add FormExtraBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new BeSimple\FormExtraBundle\BeSimpleFormExtraBundle(),
            // ...
        );
    }

### Register the BeSimple namespace

    // app/autoload.php
    $loader->registerNamespaces(array(
        'BeSimple' => __DIR__.'/../src',
        // your other namespaces
    ));

### Update your configuration

    // app/config/config.yml
    framework:
        validation:
            enabled: true
            annotations:
                namespaces:
                    formExtraValidator: BeSimple\FormExtraBundle\Validator\Constraints\
