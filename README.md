# Advocate AOP / Laravel Class Resolver

This extension enables Advocate AOP to locate classes within Laravel, for the purpose of joining aspects to any Laravel class. As this involves interaction with the Composer autoloader, it's theoretically possible (though not intended) to join aspects to any class loaded via Composer.

#### Requirements

* PHP 5.3
* Composer \*
* Laravel 4.x \*

\* Will be gracefully skipped if not available.

## Usage

Create an instance of `\Advocate\Extensions\Laravel\CoreClassResolver`.

Pass a Composer autoloader instance using `setComposerLoader` e.g.

    $classResolver->setComposerLoader(include(base_path().'/vendor/autoload.php'));

Pass the class resolver instance to Advocate:

    $advocate->addClassResolver($classResolver);

## Planned improvements

* Error handling / exceptions.