DROP TABLE CanLearn;
DROP TABLE Game_Region;
DROP TABLE Trainer_Origin;
DROP TABLE Categorised;
DROP TABLE Uses;
DROP TABLE Gym_Leader;
DROP TABLE Champion;
DROP TABLE Trainer_Info;
DROP TABLE Title_Type;
DROP TABLE Pokemon_Colour;
DROP TABLE Pokemon_Basic_Info;
DROP TABLE Move;
DROP TABLE TypeStrength;
DROP TABLE Game;
DROP TABLE Generation;
DROP TABLE Habitat;
DROP TABLE Type;

CREATE TABLE Type (
	type_name VARCHAR(10) PRIMARY KEY,
	type_description VARCHAR(200) NOT NULL,
	UNIQUE(type_description)
);

CREATE TABLE Habitat ( 
	biome_name VARCHAR(20) PRIMARY KEY,
	climate VARCHAR(20) NOT NULL
);

CREATE TABLE Generation (
	generation_number INTEGER PRIMARY KEY,
	start_year Number(4) NOT NULL,
	end_year Number(4) NOT NULL,
	UNIQUE(start_year, end_year)
);

CREATE TABLE Game (
	game_name VARCHAR(20) PRIMARY KEY,
	release_year Number(4) NOT NULL,
	generation_number INTEGER NOT NULL,
	FOREIGN KEY(generation_number)
		REFERENCES Generation(generation_number)		
);

CREATE TABLE TypeStrength (
	strong_type_name VARCHAR(10),
	weak_type_name VARCHAR(10),
	PRIMARY KEY(strong_type_name, weak_type_name),
	FOREIGN KEY(strong_type_name)
		REFERENCES Type(type_name),
	FOREIGN KEY(weak_type_name)
		REFERENCES Type(type_name)
);

CREATE TABLE Move (
	move_name VARCHAR(20) PRIMARY KEY,
	accuracy INTEGER,
	damage INTEGER,
	type_name VARCHAR(10) NOT NULL, 
	FOREIGN KEY(type_name)
		REFERENCES Type(type_name) 
);

CREATE TABLE Pokemon_Basic_Info (
	pokemon_name VARCHAR(20) PRIMARY KEY,
	generation_number INTEGER,
	biome_name VARCHAR(20),
	FOREIGN KEY(generation_number)
		REFERENCES Generation(generation_number),		
	FOREIGN KEY(biome_name)
		REFERENCES Habitat(biome_name)		
);

CREATE TABLE Pokemon_Colour (
	pokemon_name VARCHAR(20),
	shiny_status Number(1), 
	colour VARCHAR(20),
	PRIMARY KEY (pokemon_name, shiny_status)
);

CREATE TABLE Title_Type (
	title VARCHAR(30) PRIMARY KEY,
	type_name VARCHAR(20),
	FOREIGN KEY(type_name)
		REFERENCES Type(type_name)
);

CREATE TABLE Trainer_Info (
	title VARCHAR(30),
	trainer_name VARCHAR(20),
	signature_pokemon_name VARCHAR(20),
	signature_pokemon_shiny_status Number(1),
	PRIMARY KEY(title, trainer_name),
	FOREIGN KEY(signature_pokemon_name, signature_pokemon_shiny_status) 
		REFERENCES Pokemon_Colour(pokemon_name, shiny_status)
);	

CREATE TABLE Champion (
	title VARCHAR(30),
	trainer_name VARCHAR(20),
	difficulty_rating INTEGER NOT NULL,
	league_name VARCHAR(30) NOT NULL, 
	PRIMARY KEY (trainer_name, title),
	FOREIGN KEY (trainer_name, title) 
		REFERENCES Trainer_Info(trainer_name, title) ON DELETE CASCADE
); 

CREATE TABLE Gym_Leader (
	title VARCHAR(30),
	trainer_name VARCHAR(20),
	gym_location VARCHAR(20) NOT NULL,
	gym_badge VARCHAR(20) NOT NULL, 
	PRIMARY KEY (trainer_name, title),
	FOREIGN KEY (trainer_name, title) 
		REFERENCES Trainer_Info(trainer_name, title) ON DELETE CASCADE,
	UNIQUE(gym_location, gym_badge)
);

CREATE TABLE Uses (
	title VARCHAR(30),
	trainer_name VARCHAR(20),
	pokemon_name VARCHAR(20),	
	shiny_status Number(1),
	PRIMARY KEY(title, trainer_name, pokemon_name, shiny_status),
	FOREIGN KEY(title, trainer_name)
		REFERENCES Trainer_Info(title, trainer_name) ON DELETE CASCADE,
	FOREIGN KEY(pokemon_name, shiny_status)
		REFERENCES Pokemon_Colour(pokemon_name, shiny_status)
); 

CREATE TABLE Categorised (
	pokemon_name VARCHAR(20),
	type_name VARCHAR(20),
	PRIMARY KEY(pokemon_name, type_name),
	FOREIGN KEY(pokemon_name)
		REFERENCES Pokemon_Basic_Info(pokemon_name),		 
	FOREIGN KEY(type_name) 
		REFERENCES Type(type_name)		 
); 

CREATE TABLE Trainer_Origin (
	title VARCHAR(30),
	trainer_name VARCHAR(20),
	game_name VARCHAR(20),
	PRIMARY KEY(title, trainer_name, game_name),
	FOREIGN KEY(title, trainer_name)
		REFERENCES Trainer_Info(title, trainer_name) ON DELETE CASCADE,
	FOREIGN KEY(game_name)
		REFERENCES Game(game_name)	
);

CREATE TABLE Game_Region (
	game_name VARCHAR(20),
	region_name VARCHAR(20),
	named_area VARCHAR(20) NOT NULL,
	PRIMARY KEY(game_name, region_name),
	FOREIGN KEY(game_name)
		REFERENCES Game(game_name)
		ON DELETE CASCADE
); 

CREATE TABLE CanLearn (
	pokemon_name VARCHAR(20),
	move_name VARCHAR(20),
	PRIMARY KEY(pokemon_name, move_name),
	FOREIGN KEY(pokemon_name)
		REFERENCES Pokemon_Basic_Info(pokemon_name),
	FOREIGN KEY(move_name)
		REFERENCES Move(move_name)
);

/* Below are the insert statements! */

/*Type Inserts*/ /*COMPLETE*/

INSERT
INTO Type (type_name, type_description)
VALUES ('Normal', 'The Normal type is the most basic type of Pokémon. They are very common and appear from the very first route you visit.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Fire', 'Fire is one of the three basic elemental types along with Water and Grass, which constitute the three starter Pokémon.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Rock', 'Rock is a solid type as one might expect. Like Steel, Rock Pokémon usually have high defense');

INSERT
INTO Type (type_name, type_description)
VALUES ('Water', 'Water is one of the three basic elemental types along with Fire and Grass, which constitute the three starter Pokémon');

INSERT
INTO Type (type_name, type_description)
VALUES ('Grass', 'Grass is one of the three basic elemental types along with Fire and Water, which constitute the three starter Pokémon.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Fighting', 'Fighting Pokémon are strong and muscle-bound, often based on martial artists.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Flying', 'Most Flying type Pokémon are based on birds or insects, along with some mythical creatures like dragons. On average they are faster than any other type.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Psychic', 'Psychic-type Pokémon use their mental powers and telekinesis to manipulate their surroundings.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Dragon', 'Dragon-type Pokémon are powerful and often revered, usually embodying mythic and legendary creatures.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Ground', 'Ground-type Pokémon are linked to the earth, excelling in manipulating soil and rock to create seismic attacks.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Steel', 'Steel-type Pokémon are known for their incredible durability and are often made of or clad in metal, symbolizing strength and resilience.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Bug', 'Bug-type Pokémon are typically small and numerous, often based on insects and known for their fast and effective teamwork.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Electric', 'Electric-type Pokémon harness electrical energy, often generating powerful bursts of electricity and lightning.');

INSERT
INTO Type (type_name, type_description)
VALUES ('Poison', 'Poison-type Pokémon specialize in toxins and venoms, often using their noxious abilities to weaken and outlast their opponents.');

/*Habitat Inserts*/ /*COMPLETE*/

INSERT
INTO Habitat (biome_name, climate)
VALUES ('Ocean', 'Warm');

INSERT
INTO Habitat (biome_name, climate)
VALUES ('Town', 'Temperate');

INSERT
INTO Habitat (biome_name, climate)
VALUES ('Desert', 'Hot');

INSERT
INTO Habitat (biome_name, climate)
VALUES ('Mountain', 'Cold');

INSERT
INTO Habitat (biome_name, climate)
VALUES ('Forest', 'Tropical');

INSERT
INTO Habitat (biome_name, climate)
VALUES ('Cave', 'Cold');

/*Generation Inserts*/ /*COMPLETE*/

INSERT
INTO Generation (generation_number, start_year, end_year)
VALUES (1, 1996, 1998);

INSERT
INTO Generation (generation_number, start_year, end_year)
VALUES (2, 1999, 2001);

INSERT
INTO Generation (generation_number, start_year, end_year)
VALUES (3, 2002, 2005);

INSERT
INTO Generation (generation_number, start_year, end_year)
VALUES (4, 2006, 2009);

INSERT
INTO Generation (generation_number, start_year, end_year)
VALUES (5, 2010, 2012);

/*Game Inserts*/ /*COMPLETE*/

INSERT
INTO Game (game_name, release_year, generation_number)
VALUES ('Pokemon Red', 1996, 1);

INSERT
INTO Game (game_name, release_year, generation_number)
VALUES ('Pokemon Crystal', 2000, 2);

INSERT
INTO Game (game_name, release_year, generation_number)
VALUES ('Pokemon FireRed', 2004, 3);

INSERT
INTO Game (game_name, release_year, generation_number)
VALUES ('Pokemon Pearl', 2006, 4);

INSERT
INTO Game (game_name, release_year, generation_number)
VALUES ('Pokemon Black', 2010, 5);

INSERT
INTO Game (game_name, release_year, generation_number)
VALUES ('Pokemon Ruby', 2004, 3);

/*Type Strength Inserts*/ /*COMPLETE*/

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Water', 'Fire');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Fire', 'Grass');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Grass', 'Water');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Water', 'Rock');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Fighting', 'Normal');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Electric', 'Flying');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Psychic', 'Poison');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Dragon', 'Dragon');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Ground', 'Electric');

INSERT
INTO TypeStrength(strong_type_name, weak_type_name)
VALUES('Fire', 'Bug');

/*Move Inserts*/ /*COMPLETE*/

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Water Gun', 40, 100, 'Water');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Stealth Rock', NULL, NULL, 'Rock');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Hyper Beam', 150, 90, 'Normal');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Fire Blast', 110, 85, 'Fire');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Leech Seed', NULL, 90, 'Grass');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Psybeam', 65, 100, 'Psychic');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Wing Attack', 60, 100, 'Flying');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Quick Attack', 40, 100, 'Normal');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Dragon Breath', 60, 100, 'Dragon');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Earthquake', 100, 100, 'Ground');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Meteor Mash', 90, 85, 'Steel');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Flame Wheel', 60, 100, 'Fire');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Bug Buzz', 90, 100, 'Bug');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Close Combat', 90, 100, 'Fighting');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Thunderbolt', 90, 100, 'Electric');

INSERT
INTO Move (move_name, damage, accuracy, type_name)
VALUES ('Poison Powder', NULL, 75, 'Poison');


/*Pokemon_Basic_Info Inserts*/ /*COMPLETE*/

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Pidgey', 1, 'Forest');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Rattata', 1, 'Town');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Alakazam', 1, 'Town');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Dragonite', 2, 'Cave');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Garchomp', 4, 'Desert');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Metagross', 3, 'Mountain');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Volcarona', 5, 'Desert');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Onix', 1, 'Cave');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Staryu', 1, 'Ocean');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Raichu', 1, 'Forest');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Victreebel', 1, 'Forest');

INSERT
INTO Pokemon_Basic_Info (pokemon_name, generation_number, biome_name)
VALUES('Weezing', 1, 'Town');

/*Pokemon Colour Inserts*/ /*COMPLETE*/

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Pidgey', 1, 'Yellow');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Rattata', 1, 'Green');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Alakazam', 0, 'Yellow');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Dragonite', 0, 'Orange');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Garchomp', 0, 'Dark Blue');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Metagross', 0, 'Light Blue');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Volcarona', 0, 'Orange');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Onix', 0, 'Grey');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Staryu', 0, 'Yellow');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Raichu', 0, 'Orange');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Victreebel', 0, 'Green');

INSERT
INTO Pokemon_Colour(pokemon_name, shiny_status, colour)
VALUES('Weezing', 0, 'Purple');

/*Title_Type Inserts*/ /*COMPLETE*/

INSERT
INTO Title_Type (title, type_name)
VALUES('Pilot','Flying');

INSERT
INTO Title_Type (title, type_name)
VALUES('Youngster','Normal');

INSERT
INTO Title_Type (title, type_name)
VALUES('Psychic Champion', 'Psychic');

INSERT
INTO Title_Type (title, type_name)
VALUES('Dragon Champion', 'Dragon');

INSERT
INTO Title_Type (title, type_name)
VALUES('Steel Champion', 'Steel');

INSERT
INTO Title_Type (title, type_name)
VALUES('Bug Champion', 'Bug');

INSERT
INTO Title_Type (title, type_name)
VALUES('Rock Type Gym Leader', 'Rock');

INSERT
INTO Title_Type (title, type_name)
VALUES('Water Type Gym Leader', 'Water');

INSERT
INTO Title_Type (title, type_name)
VALUES('Electric Type Gym Leader', 'Electric');

INSERT
INTO Title_Type (title, type_name)
VALUES('Grass Type Gym Leader', 'Grass');

INSERT
INTO Title_Type (title, type_name)
VALUES('Poison Type Gym Leader', 'Poison');


/*Trainer Info Inserts*/ /*COMPLETE*/

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Pilot', 'Chase','Pidgey',1);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Youngster', 'Joey','Rattata', 1);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Psychic Champion', 'Blue', 'Alakazam',0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Dragon Champion', 'Lance', 'Dragonite',0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Dragon Champion', 'Cynthia', 'Garchomp',0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Steel Champion', 'Steven', 'Metagross',0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Bug Champion', 'Alder', 'Volcarona',0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Rock Type Gym Leader', 'Brock', 'Onix', 0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Water Type Gym Leader', 'Misty', 'Staryu', 0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Electric Type Gym Leader', 'Lt. Surge', 'Raichu', 0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Grass Type Gym Leader', 'Erika', 'Victreebel', 0);

INSERT
INTO Trainer_Info(title,trainer_name, signature_pokemon_name, signature_pokemon_shiny_status)
VALUES('Poison Type Gym Leader', 'Koga', 'Weezing', 0);


/*Champion Inserts*/ /*COMPLETE*/

INSERT
INTO Champion(title, trainer_name, difficulty_rating, league_name)
VALUES('Psychic Champion', 'Blue', 5, 'Indigo League');

INSERT
INTO Champion(title, trainer_name, difficulty_rating, league_name)
VALUES('Dragon Champion', 'Lance', 3, 'Indigo League');

INSERT
INTO Champion(title, trainer_name, difficulty_rating, league_name)
VALUES('Dragon Champion', 'Cynthia', 5, 'Sinnoh Pokémon League');

INSERT
INTO Champion(title, trainer_name, difficulty_rating, league_name)
VALUES('Steel Champion', 'Steven', 4, 'Hoenn League');

INSERT
INTO Champion(title, trainer_name, difficulty_rating, league_name)
VALUES('Bug Champion', 'Alder', 2, 'Unova Pokemon League');

/*Gym Leader Inserts*/ /*COMPLETE*/

INSERT
INTO Gym_Leader(title, trainer_name, gym_location, gym_badge)
VALUES('Rock Type Gym Leader', 'Brock', 'Pewter City', 'Boulder Badge');

INSERT
INTO Gym_Leader(title, trainer_name, gym_location, gym_badge)
VALUES('Water Type Gym Leader', 'Misty', 'Cerulean City', 'Cascade Badge');

INSERT
INTO Gym_Leader(title, trainer_name, gym_location, gym_badge)
VALUES('Electric Type Gym Leader', 'Lt. Surge', 'Vermillion City', 'Thunder Badge');

INSERT
INTO Gym_Leader(title, trainer_name, gym_location, gym_badge)
VALUES('Grass Type Gym Leader', 'Erika', 'Celadon City', 'Rainbow Badge');

INSERT
INTO Gym_Leader(title, trainer_name, gym_location, gym_badge)
VALUES('Poison Type Gym Leader', 'Koga', 'Fuchsia City', 'Soul Badge');

/*Uses inserts*/

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Pilot', 'Chase', 'Pidgey', 1);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Youngster', 'Joey', 'Rattata', 1);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Youngster', 'Joey', 'Pidgey', 1);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Psychic Champion', 'Blue', 'Alakazam', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Dragon Champion', 'Lance', 'Dragonite', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Dragon Champion', 'Cynthia', 'Garchomp', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Steel Champion', 'Steven', 'Metagross', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Bug Champion', 'Alder', 'Volcarona', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Rock Type Gym Leader', 'Brock', 'Onix', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Water Type Gym Leader', 'Misty', 'Staryu', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Electric Type Gym Leader', 'Lt. Surge', 'Raichu', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Grass Type Gym Leader', 'Erika', 'Victreebel', 0);

INSERT
INTO Uses(title, trainer_name, pokemon_name, shiny_status)
VALUES('Poison Type Gym Leader', 'Koga', 'Weezing', 0);

/*Categorised inserts*/ /*COMPLETE*/

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Pidgey', 'Normal');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Pidgey', 'Flying');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Rattata', 'Normal');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Alakazam', 'Psychic');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Dragonite', 'Dragon');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Dragonite', 'Flying');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Garchomp', 'Ground');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Garchomp', 'Dragon');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Metagross', 'Steel');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Metagross', 'Psychic');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Volcarona', 'Bug');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Volcarona', 'Fire');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Onix', 'Rock');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Onix', 'Ground');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Staryu', 'Water');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Raichu', 'Electric');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Victreebel', 'Grass');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Victreebel', 'Poison');

INSERT
INTO Categorised(pokemon_name, type_name)
VALUES('Weezing', 'Poison');

/*Trainer_Origin Inserts*/ /*COMPLETE*/

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Pilot', 'Chase', 'Pokemon Black');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Youngster', 'Joey', 'Pokemon Crystal');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Psychic Champion', 'Blue', 'Pokemon Red');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Dragon Champion', 'Lance', 'Pokemon Crystal');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Dragon Champion', 'Cynthia', 'Pokemon Pearl');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Steel Champion', 'Steven', 'Pokemon Ruby');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Bug Champion', 'Alder', 'Pokemon Black');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Rock Type Gym Leader', 'Brock', 'Pokemon Red');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Water Type Gym Leader', 'Misty', 'Pokemon Red');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Electric Type Gym Leader', 'Lt. Surge', 'Pokemon Red');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Grass Type Gym Leader', 'Erika', 'Pokemon Red');

INSERT
INTO Trainer_Origin (title, trainer_name, game_name)
VALUES ('Poison Type Gym Leader', 'Koga', 'Pokemon Red');

/*Game_Region Inserts*/ /*COMPLETE*/

INSERT
INTO Game_Region (game_name, region_name, named_area)
VALUES ('Pokemon Red', 'Kanto', 50);

INSERT
INTO Game_Region (game_name, region_name, named_area)
VALUES ('Pokemon Crystal', 'Johto', 46);

INSERT
INTO Game_Region (game_name, region_name, named_area)
VALUES ('Pokemon FireRed', 'Kanto', 69);

INSERT
INTO Game_Region (game_name, region_name, named_area)
VALUES ('Pokemon Pearl', 'Sinnoh', 75);

INSERT
INTO Game_Region (game_name, region_name, named_area)
VALUES ('Pokemon Black', 'Unova', 55);

INSERT
INTO Game_Region (game_name, region_name, named_area)
VALUES ('Pokemon Ruby', 'Hoenn', 78);

/*Can Learn Inserts*/ /*COMPLETE*/

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Pidgey', 'Wing Attack');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Rattata', 'Quick Attack');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Alakazam', 'Psybeam');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Dragonite', 'Dragon Breath');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Garchomp', 'Dragon Breath');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Metagross', 'Meteor Mash');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Volcarona', 'Flame Wheel');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Volcarona', 'Bug Buzz');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Onix', 'Earthquake');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Staryu', 'Water Gun');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Raichu', 'Thunderbolt');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Victreebel', 'Leech Seed');

INSERT
INTO CanLearn(pokemon_name, move_name)
VALUES('Weezing', 'Poison Powder');

COMMIT;
