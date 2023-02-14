/**
 * Defines a custom logger with different logging levels: info, warn, success, error, and debug.
 * Logs the message passed in as input to the console with a specific styling based on the level of logging.
 *
 * @see {@link https://developer.mozilla.org/en-US/docs/Web/API/console}
 *
 * @typedef {Object} Logger
 *
 * @property {function} info - Logs the message as an info message with a blue background.
 * @property {function} warn - Logs the message as a warning message with an orange background.
 * @property {function} success - Logs the message as a success message with a green background.
 * @property {function} error - Logs the message as an error message with a red background.
 * @property {function} debug - Logs the message as a debug message with a gray color.
 */


var log = {};
var style = 'font-size: 14px; padding: 5px;';

log = {
    info: (msg) => {
        ('string' == typeof (msg)) ?
            console.info(`%c${msg}`, `background: #F2FCFD; color: #1C9EAF; ${style}`) :
            console.info(JSON.parse(JSON.stringify(msg)));
    },
    warn: (msg) => {
        ('string' == typeof (msg)) ?
            console.warn(`%c${msg}`, `background: #FFE0B2; color: #FF3D00; ${style}`) :
            console.warn(JSON.parse(JSON.stringify(msg)));
    },
    success: (msg) => {
        ('string' == typeof (msg)) ?
            console.info(`%c${msg}`, `background: #F1F8E9; color: #1B5E20; ${style}`) :
            console.info(JSON.parse(JSON.stringify(msg)));
    },
    error: (msg) => {
        ('string' == typeof (msg)) ?
            console.error(`%c${msg}`, `background: #AA0000; color: #ffffff; ${style}`) :
            console.error(JSON.parse(JSON.stringify(msg)));
    },
    debug: (msg) => {
        ('string' == typeof (msg)) ?
            console.debug(`%c${msg}`, `color: #777777; ${style}`) :
            console.debug(JSON.parse(JSON.stringify(msg)));
    }
}
