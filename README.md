
First run the commands:
`composer update`
`npm update`

Configure database connection in .env file (DB_* entries like DB_CONNECTION)

Finally:
`php artisan migrate`
`php artisan migrate:fresh --seed`

To run application:
`php artisan serve` and `npm run dev`
or single command: `composer run dev`

If you have "Restore Terminals" Vscode extension active, then you do not have run the app manually. It will run automatically whenever you open Vscode on the project.


This software based on Laravel is licensed under the [MIT license](https://opensource.org/licenses/MIT).

Copyright <2025> <COPYRIGHT Udemy & Robert Apollo>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
