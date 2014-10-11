Array to delimited string data transformer
==========================================

[![Build Status](https://travis-ci.org/dantleech/symfony-form-array-to-delimited-string-transformer.svg)](https://travis-ci.org/dantleech/symfony-form-array-to-delimited-string-transformer)

This is a data transformer for the Symfony form framework.

It is meant for transforming text fields containing delimited strings to
arrays.

Usage
-----

You can use the data transformer as follows:

````php
$form->add(
    $builder->create('tags', 'text')->addModelTransformer(
        new ArrayToDelimitedStringTransformer()
    )
);
````

This will transform the ``tags`` text field as follows:

````php
// Tranform
array('one', 'two', 'three', 'four') === 'one, two, three, four'

// Reverse transform
'   one ,  two    , three, four,' === array('one', two', 'three', 'four')
````

Changing the delimiter
----------------------

You can change the delimiting string with the first constructor argument:

````php
new ArrayToDelimitedStringTransformer(';')
````

Will result in:

````php
// Transform
array('one', 'two', 'three', 'four') === 'one; two; three; four'

// Reverse Transform
'one   ; two;three ;     four' => array('one', 'two', 'three')
````

Output padding
--------------

Additionally you can change the way in which the output is formatted with
by setting the amount of whitespace (padding) before and after the text
elements produced by a transformation:

````php
new ArrayToDelimitedStringTransformer('%', 1, 1)
````

Will result in:

````php
// Transform
array('one', 'two', 'three', 'four') === 'one % two % three % four'

// Reverse Transform
'one   % two%three %     four' => array('one', 'two', 'three')
````
