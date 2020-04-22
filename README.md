# PHP-project

## Table of content
1. [git flow](git-flow)

2. [questions](questions)

### Git flow
__! pull voor je aan je code begint__

__master branch__(moet altijd werkende blijven)

__develop branch__ (tussen branch voor mergen met master)

__feature/example__(feature branch waar je 1 feature op doen)
vb. feature/register

klaar met feature branch pull request naar develop en review door teamleden voor merging (zodat er niets kapot gaat van een andere team lid door merge)

### Questions

1. register.css? omzetten naar general style.css

answer : Done

2. design?

answer : Ik heb gewoon iets van het bootstrap gehaald, dit is zeker niet definitief!

3. naming conventions php

myemail = emailValidation
getAll = getAllUsers
save = saveUser(Registration)

answer : doen? -> done, is zo idd veel makkelijker voor de rest

4. database:
    user biografie - text
    user avatar - varchar
    user password confirmation (2 keer password ingeven voor extra validation)

5. Registration 
- path meegeven default image ("images/uploads/default.png")
- bio standaard waarde meegeven ("Hey, welkom op mijn profiel.")

6. class aanmaken voor hashing en aanroepen in user classe adh van OOP

7. $firstname = $this->getFirstname(); is niet nodig mag gewoon $this->firstname zijn

8. $profiletxt -> omzetten naar $bio
