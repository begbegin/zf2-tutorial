
Instructions:

- Le fichier pre-comit-tests.php permet de lancer les tests. Pour le moment, il est minimalice et contient seulement les tests phpunit. 
Vous pouvez modifier son constructeur pour lancer seulement des tests sur un, plusieurs ou m�me tous les modules. 

- L'ex�cution des tests doit se faire avant un commit en locale: pour que cela prenne effet, vous devez copier le second fichier "pre-commit" 
	vers le repertoire ".git/hooks" se trouvant � la racine de votre projet et probablement cach�.
	
- Pour ignorer les tests avant le commit, vous devez accompagner votre commande "git commit" avec l'option "--no-verify"