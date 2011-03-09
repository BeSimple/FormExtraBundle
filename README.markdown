## Information

ExtraValidatorBundle offer new validator constraints for your Symfony2 project.

"This repository hosts ExtraValidatorBundle that do not belong to the core of Symfony2 but can
be nonetheless interesting to share with other developers.

Fork this repository, add your extension, and request a pull." Fabien Potencier

## Installation

### Add ExtraValidatorBundle to your src/BeSimple directory

    git submodule add git://github.com/francisbesset/ExtraValidatorBundle.git src/BeSimple/ExtraValidatorBundle

### Add ExtraValidatorBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new BeSimple\ExtraValidatorBundle\BeSimpleExtraValidatorBundle(),
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
    be_simple_extra_validation: ~
    
    framework:
        validation:
            enabled: true
            annotations:
                namespaces:
                    extraValidator: BeSimple\ExtraValidatorBundle\Validator\Constraints\