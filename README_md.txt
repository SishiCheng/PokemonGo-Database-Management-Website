# Pokedex Project

This is the read me file for pokedex project.
For now, we set up the system as new user are default admin user for grading purporse. 


# Home Page
http://cmpsc431-s3-g-12.vmhost.psu.edu/start.php

# Admin Login

Username: group12
Password: pokemon

# Project Login

User can sign up and login to the project by login and sign up page. Once user login, user will be dirscted to the hopmepage. 

# Project Desription

The project can add and delete pokemon into index, print top 15 pokemon by flee rate, fast move,  or damage per second modify evolution chian.


## Home Page

List all the polkemons currently stored in the database. User can click Pokename to see detailed desciption. Admin can press the delete button to delete it form the pokedex

## Pokemon Lookup

To serach pokemon according user's condition.

## Modify Pokemon

Need to login in order to use this function and this would be a admin only feature. This page modified the property of pokemon. This uses tranaction to ensure data concurrency. 

## Show Evolution Chain

To see evolution chaine for the pokemon. We can list all pokemon or list by type of pokemon. Poke ID 0 represents this pokemon does not evolve to or from any pokemon.

## Add Evoluion Chian

This page is a admin only feature, it add a evoultion chain to the table. This uses tranaction to ensure data concurrency. 

## Delete Evolution Chian

This page is admin only and can delete a evolution relation. This uses tranaction to ensure data concurrency. 

## Modify Evolution

This page modifiy an existing evolution relation. And use transaction to handle data concurrency problem. 

## Top 15 Flee rate

This function list top 15 pokemons for flee rate. User can sort this table by height, weight, catch rate and flee rate. 

## Top By Charge Move

This function list top 15 pokemons for charge move. User can sort this table by height, weight, catch rate and flee rate. 

## Top15 by Fast Move

This function list top 15 pokemons for fast move. User can sort this table by height, weight, catch rate and flee rate. 

# Error Handeling

All the error will be catched by try cathc method. For login and signup, it will prompt user if they entered invalid data such as username already taken, password not match. 
Also, the inconsistent data entered into database will automatically rolled back to the correct state and will report to the user. 







