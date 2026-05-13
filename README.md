# Kaartenbak P.J. Ros - Project Structure

## Mappenstructuur / Folder Structure

```
elementa-ross/
├── index.php                 # Entry point / authenticatie
├── includes/
│   ├── config.php           # Database configuratie
│   └── databaseconnector.php # Database connectie functie
├── auth/
│   └── login.php            # Login pagina
├── pages/
│   ├── inventaris.php       # Inventaris overzicht
│   └── kaart.php            # Kaart weergave/bewerking
└── public/
    ├── css/
    │   └── abonn.css        # Stylesheet
    └── images/
        ├── logo2.jpg        # Logo afbeelding
        └── edit.gif         # Edit icoon
```

## Bestanden / Files

- **index.php** - Hoofdinvoerpunt, controleert authenticatie en redirects naar inventaris
- **includes/config.php** - Database connectieparameters
- **includes/databaseconnector.php** - Database connectiefunctie
- **auth/login.php** - Login formulier en authenticatie
- **pages/inventaris.php** - Kaarten overzicht
- **pages/kaart.php** - Kaart details en bewerking
- **public/css/abonn.css** - Stylesheets
- **public/images/** - Afbeeldingen (logo, iconen)

## Setup instructies

1. Zet afbeeldings- en CSS-bestanden in hun respectieve mappen
2. Controleer database connectie instellingen in `includes/config.php`
3. Zorg dat de database tabel `kernen` bestaat met kolommen `id` en `title`
