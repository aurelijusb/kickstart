const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'http://127.0.0.1:8000';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};

// Uncomment during local development:
// beforeEach(function () {
//     cy.exec(`../../scripts/mysql.sh "TRUNCATE user;"`);
//     cy.exec(`../../scripts/insert-test-user.sh`);
// });

describe('Third homework', function() {
    it('Whole page: Homepage', () => {
        cy.visit(basePath);
        cy.screenshot();
    });
    it('Whole page: Login', () => {
        cy.visit(`${basePath}/login`);
        cy.screenshot();
    });
    it('Whole page: Register', () => {
        cy.visit(`${basePath}/register`);
        cy.screenshot();
    });

    it('Register new user', () => {
        d('Užsiregistruojame');
        cy.visit(`${basePath}/register`);
        cy.get("#registration_form_email").type('aurelijus@banelis.lt');
        cy.get("#registration_form_plainPassword").type('slaptas'); // Not for production use
        cy.get("#registration_form_homepage").type('https://aurelijus.banelis.lt');
        cy.get("#registration_form_linkedin").type('https://www.linkedin.com/in/aurelijusbanelis');
        cy.get("#registration_form_agreeTerms").check();
        cy.get('form').submit();

        d('Einame į profilio puslapį');
        cy.contains("Naudotojas");
        cy.get('.nav-link > b')
            .contains("aurelijus@banelis.lt")
            .click();

        d('Profilio puslapyje ieškome LinkedIn');
        cy.url().should('include','/profile');
        cy.screenshot();
        cy.contains(/Website/i);
        cy.contains("https://aurelijus.banelis.lt");
        cy.contains(/LinkedIn/i);
        cy.contains("https://www.linkedin.com/in/aurelijusbanelis");


        d('Tikimės nerasti administravimo nurodos paprastam naudotojui');
        cy.contains('Administravimas').should('not.exist');

        d('Atsijungiame');
        cy.contains("Atsijungti").click();
        cy.contains("Prisijungti");
    });

    it('Access admin panel', () => {
        d('Prisjungiame');
        cy.visit(`${basePath}/login`);
        cy.get('#inputEmail').type("admin@admin.lt");
        cy.get('#inputPassword').type("slaptas"); // Not for production use
        cy.get('form').submit();

        d('Einame į profilio puslapį');
        cy.contains("Naudotojas");
        cy.contains("admin@admin.lt");
        cy.contains("Administravimas").click();
        cy.screenshot();

        d('Administravimo puslapyje');
        cy.screenshot();
        cy.url().should('include','/admin');
        cy.contains("admin@admin.lt");
        cy.contains("kitas@kitas.lt");
        cy.contains(/Homepage/i);
        cy.contains("www.linkedin.com/company/nfq/");
    })
});
