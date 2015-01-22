Feature: Checking index site

  Scenario: Hello world page
    Given I am on homepage
     Then the response status code should be 200
     Then I should see "Sklep internetowy."
