import {NfqTeams} from "./nfqTeams";
import {teamsData} from "./teamsData";

// It could be refactored to more JavaScrip style
require('bootstrap');
window.onload = () => {
    let data = teamsData;
    let domElement = document.getElementById('dynamicMember');
    if (NfqTeams && domElement) {
        domElement.innerHTML = 'Giedriaus komanda: ' + NfqTeams.getTeamByMentor(data, 'Giedrius Gerulis');
    }
};