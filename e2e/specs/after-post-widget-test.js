/**
 * This file contains the widget tests after it is deployed on a page.
 */
const timeout = 10000;
const URL = 'http://assignment.local/wip/';

beforeAll(async () => {
	await page.goto(URL, { waitUntil: 'domcontentloaded' });
});

describe('Test title and accordian widget', () => {
	test(
		'Title of the page',
		async () => {
			const title = await page.title();
			expect(title).toBe('WIP – assignment');
		},
		timeout
	);

	test(
		'Accordian widget loaded',
		async () => {
			const accordian = await page.$eval('.accordian', el => el.textContent.trim());
			expect(accordian).toBeTruthy();
		},
		timeout
	);

	test(
		'Accordian heading click',
		async () => {
			const accordianHeading = await page.$eval('.accordian__heading', el => el.textContent.trim());
			if( accordianHeading ){
				await page.click('.accordian__heading');
			}
			expect(accordianHeading[0]).toBe('L');
		},
		timeout
	);

	test(
		'CTA button click',
		async () => {
			const accordianButton = await page.$eval('.accordian__button', el => el.textContent.trim());
			if( accordianButton ){
				await page.click('.accordian__heading');
			}
			expect(accordianButton).toBe('first');
		},
		timeout
	);
});
