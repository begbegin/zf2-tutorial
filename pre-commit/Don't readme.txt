
Instructions:

- Le fichier pre-comit-tests.php permet de lancer les tests. Pour le moment, il est minimalice et contient seulement les tests phpunit. 
Vous pouvez modifier son constructeur pour lancer seulement des tests sur un, plusieurs ou même tous les modules. 

- L'exécution des tests doit se faire avant un commit en locale: pour que cela prenne effet, vous devez copier le second fichier "pre-commit" 
	vers le repertoire ".git/hooks" se trouvant à la racine de votre projet et probablement caché.
	
- Pour ignorer les tests avant le commit, vous devez accompagner votre commande "git commit" avec l'option "--no-verify"