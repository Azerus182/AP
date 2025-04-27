<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/_View/View.php");

class Preadmission extends View {
    private $medics;

    public function __construct($medics) {
        $this->medics = $medics;
    }

    private function renderMedic() {
        $render = "";

        foreach ($this->medics as $medic) {
            $render .= '<option value="'.$medic["id"].'">Dr. '.$medic["lastname"].' '.$medic["firstname"].'</option>';
        }
        return ($render);
    }

    public function __toString() {
        return ('
            <div class="preadmission">
                <div class="header">
                    <p class="valid">Hospitalisation</p>
                    <p>Couverture Sociale</p>
                    <p>Patient</p>
                    <p>Proches</p>
                    <p>Documents</p>
                </div>
                <div class="pages">
                    <div class="page focused" id="pageHospitalisation">
                        <p class="title">Hospitalisation</p>
                        <label for="preadmission-type">Pré-admission pour: *</label>
                        <select name="preadmission-type" required>
                            <option value="" disabled selected>Choix</option>
                            <option value="0">Ambulatoire</option>
                            <option value="1">Hospitalisation</option>
                        </select>
                        <label for="day">Date d\'hospitalisation: *</label>
                        <input type="date" name="day" min="'.date('Y-m-d').'" required>
                        <label for="time">Heure d\'hospitalisation: *</label>
                        <input type="time" name="time" required>
                        <label for="medic">Nom du médecin: *</label>
                        <select name="medic" required>
                            <option value="" disabled selected>Choix</option>
                            '.$this->renderMedic().'
                        </select>
                    </div>
                    <div class="page" id="pageInsurance">
                        <p class="title">Couverture sociale</p>
                        <label for="insuranceFund">Organisme de sécurité sociale / Nom de la caisse d\'assurance maladie: *</label>
                        <input type="text" name="insuranceFund" required>
                        <label for="ssn">Numérode sécurité sociale: *</label>
                        <input type="text" name="ssn" placeholder="123456789012345" pattern="^[1-2]{1}[0-9]{2}[0-1]{1}[0-9]{1}[0-9a-zA-Z]{2}[0-9]{8}$" required>'

                        // [1-2]{1}         Sexe
                        // [0-9]{2}         Année de naissance
                        // [0-1]{1}[0-9]{1} Mois de naissance
                        // [0-9a-zA-Z]{2}   Departement de naissance
                        // [0-9]{3}         Commune de naissance
                        // [0-9]{3}         Ordre d'enregistrement
                        // [0-9]{2}         Clé de sécurité

                        // Simplified:
                        // [1-2]{1}[0-9]{2}[0-1]{1}[0-9]{1}[0-9a-zA-Z]{2}[0-9]{8}
                        .'
                        <label for="patientIsPolicyHolder">Le patient est l\'assuré: *</label>
                        <select name="patientIsPolicyHolder" required>
                            <option value="" disabled selected>Choix</option>
                            <option value="TRUE">Oui</option>
                            <option value="FALSE">Non</option>
                        </select>
                        <label for="isDisabled">Le patient est en ALD: *</label>
                        <select name="isDisabled" required>
                            <option value="" disabled selected>Choix</option>
                            <option value="TRUE">Oui</option>
                            <option value="FALSE">Non</option>
                        </select>
                        <label for="mutualInsuranceName">Nom de la mutuelle ou de l\'assurance: *</label>
                        <input type="text" name="mutualInsuranceName" required>
                        <label for="mutualInsuranceName">Numéro d\'adherent: *</label>
                        <input type="text" name="mutualInsuranceName" required>
                        <label for="separateRoom">Chambre particulière: *</label>
                        <select name="separateRoom" required>
                            <option value="" disabled selected>Choix</option>
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>
                    <div class="page" id="pagePatient">
                        <p class="title">Patient</p>
                        <label for="civ">Civilitée: *</label>
                        <select name="civ" required>
                            <option value="" disabled selected>Choix</option>
                            <option value="FALSE">Homme</option>
                            <option value="TRUE">Femme</option>
                        </select>
                        <label for="birthname">Nom de naissance: *</label>
                        <input type="text" name="birthname" required>
                        <label for="mariedName">Nom d\'épouse:</label>
                        <input type="text" name="mariedName">
                        <label for="firstname">Prénom: *</label>
                        <input type="text" name="firstname" required>
                        <label for="birthday">Date de naissance: *</label>
                        <input type="date" name="birthday" required onchange="setChildMod(this.value)" max="'.date('Y-m-d').'">
                        <label for="address">Adresse: *</label>
                        <input type="text" name="address" required>
                        <label for="zipCode">Code Postal: *</label>
                        <input type="text" name="zipCode" pattern="[0-9]{5}" required>
                        <label for="city">Ville: *</label>
                        <input type="text" name="city" required>
                        <label for="email">Email: *</label>
                        <input type="email" name="email" required>
                        <label for="phone">Telephone: *</label>
                        <input type="text" name="phone" pattern="^[0-9]{10}$" required>
                    </div>
                    <div class="page" id="pageContact">
                        <p class="title">Personne à contacter</p>
                        <label for="contactName">Nom:</label>
                        <input type="text" name="contactName">
                        <label for="contactFirstname">Prénom:</label>
                        <input type="text" name="contactFirstname">
                        <label for="contactPhone">Téléphone:</label>
                        <input type="text" name="contactPhone">
                        <label for="contactAddress">Adresse:</label>
                        <input type="text" name="contactAddress">

                        <p class="title">Personne de confiance</p>
                        <label for="trustName">Nom:</label>
                        <input type="text" name="trustName">
                        <label for="trustFirstname">Prénom:</label>
                        <input type="text" name="trustFirstname">
                        <label for="trustPhone">Téléphone:</label>
                        <input type="text" name="trustPhone">
                        <label for="trustAddress">Adresse:</label>
                        <input type="text" name="trustAddress">
                    </div>
                    <div class="page" id="pageFiles">
                        <p class="title">Pieces à joindre</p>
                        <label for="identityCard">Carte d\'dentitée (recto / verso):</label>
                        <input type="file" id="identityCard" name="identityCard" accept="image/png, image/jpeg" />

                        <label for="vitalCard">Carte vitale:</label>
                        <input type="file" id="vitalCard" name="vitalCard" accept="image/png, image/jpeg" />

                        <label for="mutualCard">Carte de mutuelle:</label>
                        <input type="file" id="mutualCard" name="mutualCard" accept="image/png, image/jpeg" />

                        <div class="minor">
                            <p class="title">Pour les enfants mineurs</p>
                            <label for="famillyBook">Livret de famille (pour enfants mineurs):</label>
                            <input type="file" id="famillyBook" name="famillyBook" accept="image/png, image/jpeg" />

                            <label for="childAuthorization">Autorisation de soin et d\'opérer signé par les deux représentants légaux:</label>
                            <input type="file" id="childAuthorization" name="childAuthorization" accept="image/png, image/jpeg" />

                            <label for="singleParentAuthorization">En cas de monoparentalité, la décision du juge:</label>
                            <input type="file" id="singleParentAuthorization" name="singleParentAuthorization" accept="image/png, image/jpeg" />
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <button onclick="preadmissionPagePrevious()">Précédent</button>
                    <button onclick="preadmissionPageNext()">Suivant</button>
                    <button onclick="sendForm()">Valider</button>
                </div>
            </div>
        ');
    }
}
?>