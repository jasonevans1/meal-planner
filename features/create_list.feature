Feature: Create List
    As a user
    I want to be able to create lists
    So that I can organized tasks

    Background:
        Given I am logged in

    Scenario: User creates list with valid data
        When the user creates a list with valid data
        Then the user should see a successful created list message

    Scenario: User creates list without title
        When the user creates a list without a title
        Then the user should see a missing title message
