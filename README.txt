Setarile locale se fac in app/config/config.local.php

Datorita setarilor din .htaccess toate requesturile ajung la index.php

Acolo se analizeaza URL-ul si se identifica controller-ul care se ocupa de request, precum si ce metoda anume din controller e apelata; apoi se executa acea metoda.


1. Ca prim pas, analizati bine cum functioneaza framework-ul sa intelegeti structura


2. Uitati-va cum sunt implementate lucruri ca:

	- Modelele (ex: model_admin)
	- Formularele (ex: formularul de login)
	- Etc.

E important sa intelegeti tot mersul:

- ce se face in controller
	- se instantiaza modele, se fac procesari de formulare etc
- ce se face in model
	- singurul loc unde se acceseaza baza de date
	- modul in care e implementat un model:
		- sunt metode statice pentru toate actiunile ce nu sunt strict legate de o instanta a unui obiect
			- de exemplu le folositi sa instantiati obiecte: model_admin::load_by_id($id) sau sa validati
		- sunt metode non-statice pentru actiunile ce tin de un obiect
			- model_admin->logout()
			- sau un exemplu mai bun:

				$cake = model_cake::load_by_id($id_prajitura)
				$cake->get_ingredients();

				metoda get_ingredients() ar fi ceva de genul:

					- instantiati $db
					- scoateti printr-un query din tabela de legatura toate id-urile de ingrediente ale prajiturii
					- faceti un loop prin aceste id-uri si instantiati model_ingredient::load_by_id($id)
					- returnari un array de obiecte de tip model_ingredient

- ce se face in view
	- html va fi doar in view
	- nu se fac procesari, ci doar se folosesc variabile pe care le-ai initializat in controller
	- etc


3. Faceti sitemap-ul de care ziceam si trimiteti-mi-l pe mail si revin cu feedback diseara de cum sa impartim


4. Adaugati-mi va rog pe Trello si pe proiectul de pe Github


5. Daca ramane timp, puteti sa incepeti sa faceti fiecare cate un model. Doar modelul deocamdata, ca sa testati puteti face un controller_test de exemplu. Nu incepeti sa lucrati la controllere sau view-uri va rog


7. E si un sql care creaza baza de date cu tabela admin.


8. Astept intrebari :)