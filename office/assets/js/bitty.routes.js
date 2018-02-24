var app = angular.module('bittyApp');

app.config(['$urlRouterProvider','$stateProvider','$locationProvider', function($urlRouterProvider,$stateProvider,$locationProvider){
	// $locationProvider.html5Mode(true);
	$urlRouterProvider.otherwise('/home');

	$stateProvider
	.state('home', {
		url: '/home',
		templateUrl: './assets/tpl/dashboard.html',
		data: {
			pageTitle: 'Dashboard'
		}
	})
	.state('transactions', {
		url: '/transactions',
		templateUrl: './assets/tpl/transac.html',
		data: {
			pageTitle: 'Transactions'
		}
	})
	.state('security', {
		url: '/security',
		templateUrl: './assets/tpl/sec.html',
		data: {
			pageTitle: 'Security'
		}
	})
	.state('faq', {
		url: '/faq',
		templateUrl: './assets/tpl/faq.html',
		data: {
			pageTitle: 'FAQ'
		}
	})
	.state('root', {
		url: '/root',
		templateUrl: './assets/tpl/index.html',
		data: {
			pageTitle: 'index'
		}
	})
	.state('ApiDocumentation', {
		url: '/ApiDocumentation',
		templateUrl: './assets/tpl/ApiDocumentation.html',
		data: {
			pageTitle: 'Api Documentation'
		}
	})
	.state('apintegration', {
		url: '/apintegration',
		templateUrl: './assets/tpl/apintegration.html',
		data: {
			pageTitle: 'apintegration'
		}
	})
	.state('conversions', {
		url: '/conversions',
		templateUrl: './assets/tpl/Conversions.html',
		data: {
			pageTitle: 'conversions'
		}
	})
	.state('Custormers', {
		url: '/Custormers',
		templateUrl: './assets/tpl/Custormers.html',
		data: {
			pageTitle: 'Custormers'
		}
	})
	.state('GettingStarted', {
		url: '/GettingStarted',
		templateUrl: './assets/tpl/GettingStarted.html',
		data: {
			pageTitle: 'Getting Started'
		}
	})
	.state('profile', {
		url: '/profile',
		templateUrl: './assets/tpl/profile.html',
		data: {
			pageTitle: 'Profile'
		}
	})
	.state('help', {
		url: '/help',
		templateUrl: './assets/tpl/help.html',
		data: {
			pageTitle: 'help'
		}
	})
	.state('income', {
		url: '/income',
		templateUrl: './assets/tpl/income.html',
		data: {
			pageTitle: 'income'
		}
	})
	.state('invoice', {
		url: '/invoice',
		templateUrl: './assets/tpl/invoice.html',
		data: {
			pageTitle: 'invoice'
		}
	})
	.state('justGage', {
		url: '/justGage',
		templateUrl: './assets/tpl/justGage.html',
		data: {
			pageTitle: 'justGage'
		}
	})
	.state('LiveHelpDesk', {
		url: '/LiveHelpDesk',
		templateUrl: './assets/tpl/LiveHelpDesk.html',
		data: {
			pageTitle: 'Live Help Desk'
		}
	})
	.state('Notification', {
		url: '/Notification',
		templateUrl: './assets/tpl/Notification.html',
		data: {
			pageTitle: 'Notification'
		}
	})
	.state('Paymentpage', {
		url: '/paymentpage',
		templateUrl: './assets/tpl/Paymentpage.html',
		data: {
			pageTitle: 'Payment Page'
		}
	})
	.state('preferences', {
		url: '/preferences',
		templateUrl: './assets/tpl/preferences.html',
		data: {
			pageTitle: 'preferences'
		}
	})
	.state('SetupWizard', {
		url: '/SetupWizard',
		templateUrl: './assets/tpl/SetupWizard.html',
		data: {
			pageTitle: 'Setup Wizard'
		}
	})
	.state('Transfers', {
		url: '/Transfers',
		templateUrl: './assets/tpl/Transfers.html',
		data: {
			pageTitle: 'Transfers'
		}
	})
	.state('Turorials', {
		url: '/Turorials',
		templateUrl: './assets/tpl/turorials.html',
		data: {
			pageTitle: 'Turorials'
		}
	})
	.state('wallet information', {
		url: '/Turorials',
		templateUrl: './assets/tpl/turorials.html',
		data: {
			pageTitle: 'Turorials'
		}
	})
	.state('login', {
		url: '/login',
		templateUrl: './assets/tpl/pagelogin.html',
		data: {
			pageTitle: 'login'
		}
	})
	.state('WalletInfo', {
		url: '/WalletInfo',
		templateUrl: 'WalletInfo.html',
		data: {
			pageTitle: 'Wallet Information'
		}
	})
}]);