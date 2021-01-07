# Integration Test Case Demo (Symfony 5)

## A demo of an integration test case for Symfony 5, that supports automatic migrations and running integration tests in an in-memory sqlite database.

The integration test case class in this project (in `tests/TestCases/Integration`) helps you when you create integration tests that require database interaction. The test case builds the database schema for you, based on your migrations, instead of you having to migrate your migrations through a `bin/console` command.

A benefit of this is that you can run your tests in an in-memory sqlite database. An in-memory database is fast, but also very practical if you'd like to run your tests in a CI/CD pipeline and don't want to setup a MySQL or Postgres database on the pipeline runner instance.

In this project you will find some example tests that extend on the integration test case. These tests show the basics of how to use the integration test case. For example, you can use `$this->getEntityManager()` to access the entity manager and communicate with the database, or `$this->getKernelBrowser()` to perform integration tests on your controllers.

To run the tests in this project locally, you first have to clone this project. After cloning the project, install the required dependencies with Composer, by running:

```shell
composer install
```

Once the required dependencies are installed, use the following command to run the tests:

```shell
bin/phpunit --testdox
```

Feel free to use the integration test case (in `tests/TestCases/Integration`) for your own projects. I'd love to hear if it helps you in your workflow.

If you find any mistakes, please let me know by posting an issue or creating a pull request.

_Disclaimer:_

_This project is meant to showcase the integration test case class and is provided as is. This project is not suitable for production._

---

_Created by: Reinder van Bochove ([@iamreinder](https://www.github.com/iamreinder) / [www.iamreinder.dev](https://iamreinder.dev))_
