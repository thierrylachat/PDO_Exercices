<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <p>Bienvenue</p>
    <p><?= $userInfo->id_users; ?></p>
    <p><?= $userInfo->login; ?></p>
    <p><?= $userInfo->password; ?></p>
</body>
</html>