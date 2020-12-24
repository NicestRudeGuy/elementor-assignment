/**
 * External dependencies
 */
const path = require('path');

/**
 * Internal dependencies
 */
const { hasBabelConfig } = require('@wordpress/scripts/utils');

const jestE2EConfig = {
  preset: 'jest-puppeteer',
  testURL: 'http://assignment.local/',
  testTimeout: 50000,
  testMatch: ['**/?(*.)spec.[jt]s', '**/specs/**/*.[jt]s'],
  testPathIgnorePatterns: [
    '/node_modules/',
    '/wordpress/',
  ],
};

if (!hasBabelConfig()) {
  jestE2EConfig.transform = {
    '^.+\\.[jt]sx?$': path.join(
      __dirname,
      'node_modules/@wordpress/scripts/config/babel-transform'
    ),
  };
}

module.exports = jestE2EConfig;
