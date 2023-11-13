# PHP Result Monad Library

## Overview

The PHP Result Monad library provides a simple and effective way to handle the results of actions, offering an alternative approach to exception handling without the need for throwing exceptions. The core component of this library is the `Result` class, which encapsulates the outcome of an action and can be created from either a successful value or an exception.

## Result Class

### Factory Methods

#### createFromValue

```php
/**
 * @param mixed $value The value associated with the result.
 * @return Result The successful Result which includes the value.
 */
public static function createFromValue(mixed $value): self
```
-> Creates a successful `Result` instance with the provided value.

#### createFromException

```php
/**
 * @param Exception $exception The exception that explains why the result was not successful.
 * @return Result The not successful Result that includes the exception.
 */
public static function createFromException(Exception $exception): self
```
-> Creates a not successful `Result` instance with the provided exception.

### Public Methods

#### Getters
- `getValue` -> Returns the value associated with the result.
- `getException` -> Returns the exception associated with the result
- `isSuccess` -> Returns a boolean indicating whether the action was successful.

#### match
```php
/**
 * @param callable $valueCallback The callback for successful results.
 * @param callable $exceptionCallback The callback for unsuccessful results.
 * @return mixed The return value of the callback that has been called.
 */
public function match(callable $valueCallback, callable $exceptionCallback): mixed
```
-> Allows matching on the result, executing the appropriate callback based on success or failure.

### Usage

Here's a brief example demonstrating the basic usage of the `Result` class:

```php
// Create a successful result with a value
$successResult = Result::createFromValue('Hello, Result!');

// Create an unsuccessful result with an exception
$exception = new \Exception('Something went wrong.');
$failureResult = Result::createFromException($exception);

// Match on the results
$successMessage = $successResult->match(
    fn ($value) => 'Success: ' . $value,
    fn ($exception) => 'Failure: ' . $exception,
);

$failureMessage = $failureResult->match(
    fn ($value) => 'Success: ' . $value,
    fn ($exception) => 'Failure: ' . $exception,
);

echo $successMessage; // Will display 'Success: Hello, Result!' -> as the `Result` was successful
echo $failureMessage; // Will display 'Failure: Something went wrong.' -> as the `Result` was not successful
```