Feature: I would like to edit items

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/sklep"
    Then I should not see "<items>"
     And I follow "Create a new entry"
    Then I should see "Item creation"
    When I fill in "Title" with "<item>"
     And I fill in "Content" with "<content>"
     And I press "Create"
    Then I should see "<item>"

  Examples:
    | item                    | content   |
    | Chleb | jakis tekst   |


  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/sklep"
    Then I should not see "<new-item>"
    When I follow "<old-item>"
    Then I should see "<old-item>"
    When I follow "Edit"
     And I fill in "Title" with "<new-item>"
     And I fill in "Content" with "<new-item>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-item>"
     And I should not see "<old-item>"

  Examples:
    | old-item         | new-item             | new-content |
    | Drewno | Test |
   

  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/sklep"
    Then I should see "<item>"
    When I follow "<item>"
    Then I should see "<item>"
    When I press "Delete"
    Then I should not see "<item>"

  Examples:
    |  item|
    | Test|
   