# SNS Message Validation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/japseyz/sns-message-validator.svg?style=flat-square)](https://packagist.org/packages/japseyz/sns-message-validator)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/japseyz/sns-message-validator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/japseyz/sns-message-validator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/japseyz/sns-message-validator/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/japseyz/sns-message-validator/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/japseyz/sns-message-validator.svg?style=flat-square)](https://packagist.org/packages/japseyz/sns-message-validator)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/sns-message-validator.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/sns-message-validator)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require japseyz/sns-message-validator
```

## Usage

Create a controller to extend SNSWebhookController

```php

class MyWebhookController extends SNSWebhookController {
```

Within that class, you may create any SNS notification you want to listen to.

Eg. onDelivery, for SES:

```php
protected function onDelivery(array $message, array $originalMessage, Request $request, Collection $headers): void
{
    // Do something with the message
}
```

Possible SES events:
- Bounce
- Complaint
- Delivery
- Send
- Reject
- Open
- Click
- RenderingFailure
- DeliveryDelay
- Subscription


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jesper Jacobsen](https://github.com/JapSeyz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
