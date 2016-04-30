Feature: SearchAPI Page needs to work
  Needs to do what it does now
  As an anonymous user
  So I know this upgrade worked :)


  Scenario: On the SearchAPI page
    Given I am on SearchAPI page
    Then there should be json goodness on the page

  Scenario: Search for something
    Given I search for foo
    Then I should get only so many results
    And that should be less than the total results the system offers
