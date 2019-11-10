// const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'https://hw1.nfq2019.online';
//FIXME: use container tests
const basePath = 'https://hw1.nfq2019.online';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

describe('First homework', function() {
    it('Have students block', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .then(data => data.map((index, element) => element.innerText).get())
            .then(students => {
                cy.wrap(students).each(student => dd(`Student: ${student}`));
            }).then( students => {
                assert.equal(students.length, 46, "Expected 46 elements of students");
            }).then( students => {
                cy.wrap(students).each(e => {
                    expect(e).contain("Mentorius");
                })
            });

        cy.contains("Studentai").parent().screenshot();
    });
    it('Have correct students-mentor data', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .first()
            .contains("Tadas")
            .parent()
            .contains("Mantas");
    });

    it('Have project block', () => {
        cy.visit(basePath);
        cy.contains("Projektai").parent().screenshot();
    });

    it('Have form block', () => {
        cy.visit(basePath);
        cy.contains("Sužinoti vertinimą").parent().screenshot();
    });

    it('Whole page', () => {
        cy.visit(basePath);
        cy.screenshot();
    });

    it('Click on first student', () => {
        cy.visit(basePath);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .first().children('a').click();

        d("Expected inner page");
        cy.contains("Studentas");
        cy.contains("Projektas");
        cy.screenshot();

        cy.contains("Visi studentai").click()
    });

    it('Click on Data file', () => {
        cy.visit(basePath);
        cy.contains("Duomenų failas").then( a => {
            const link = a.attr('href');
            cy.wrap([link]).each(link => dd(`Data file link: ${link}`))
        }).then( links => {
            const link = links[0];
            expect(link).to.eq("students.json");
        })
    });
});
