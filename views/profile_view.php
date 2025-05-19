<?php global $user; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 profile-card">
            <div class="profile-title">Mon Profil</div>
            <div class="profile-info">
                <div class="form-group">
                    <label>Nom :</label>
                    <p><?php echo htmlspecialchars($user['nom']); ?></p>
                </div>
                <div class="form-group">
                    <label>Prénom :</label>
                    <p><?php echo htmlspecialchars($user['prenom']); ?></p>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <?php if (isset($user['tel'])): ?>
                <div class="form-group">
                    <label>Téléphone :</label>
                    <p><?php echo htmlspecialchars($user['tel']); ?></p>
                </div>
                <?php endif; ?>
                <?php if (isset($user['adresse'])): ?>
                <div class="form-group">
                    <label>Adresse :</label>
                    <p><?php echo htmlspecialchars($user['adresse']); ?></p>
                </div>
                <?php endif; ?>
                <a href="modifier-profil.php" class="btn btn-success mt-3">Modifier mes informations</a>
            </div>
        </div>
    </div>
</div>