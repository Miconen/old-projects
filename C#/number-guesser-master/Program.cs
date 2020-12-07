using System;
namespace ConsoleApp1
{
    public class Program
    {
        public static void validateInput(int[] gameParameters)
        {
            // Validating input.
            try
            {
                // Ask for, parse and store user input
                var userInput = double.Parse(Console.ReadLine());
                if (userInput == gameParameters[1])
                {
                    // Correct input and exit.
                    gameParameters[0] += 1;
                    Console.Clear();
                    Console.WriteLine("Your guess was correct in {0} guesses!", gameParameters[0]);
                    Console.WriteLine("Press any key to exit...");
                    Console.ReadKey();
                }
                else if (userInput > 100 || userInput < 1)
                {
                    // Input not within scope.
                    gameParameters[0] += 1;
                    Console.Clear();
                    Console.WriteLine("Feed me a number between 1-100. Your guesses: {0}.", gameParameters[0]);
                    Console.WriteLine("Make sure your number is within the scope.");
                    validateInput(gameParameters);
                }
                else
                {
                    if (userInput >= gameParameters[1])
                    {
                        // Correct input, incorrect guess (Higher than target).
                        gameParameters[0] += 1;
                        Console.Clear();
                        Console.WriteLine("Feed me a number between 1-100. Your guesses: {0}.", gameParameters[0]);
                        Console.WriteLine("Incorrect answer. (Target is lower than {0})", userInput);
                        validateInput(gameParameters);
                    };
                    if (userInput <= gameParameters[1])
                    {
                        // Correct input, incorrect guess (Lower than target).
                        gameParameters[0] += 1;
                        Console.Clear();
                        Console.WriteLine("Feed me a number between 1-100. Your guesses: {0}.", gameParameters[0]);
                        Console.WriteLine("Incorrect answer. (Target is higher than {0})", userInput);
                        validateInput(gameParameters);
                    };
                }
            }
            // Catch non integer inputs.
            catch (FormatException)
            {
                // Invalid input.
                gameParameters[0] += 1;
                Console.Clear();
                Console.WriteLine("Feed me a number between 1-100. Your guesses: {0}.", gameParameters[0]);
                Console.WriteLine("Naughty input.");
                validateInput(gameParameters);
            }
        }
        public static void Main()
        {
            // Define target number and tries.
            var tries = 0;
            Random random = new Random();
            int target = random.Next(1, 101);
            Console.WriteLine("Debug: {0}", target);

            // Ask for input. Go to input validation (validateInput) with random number target as parameter.
            Console.WriteLine("Feed me a number between 1-100.");
            int[] gameParameters = new int[2] { tries, target };
            validateInput(gameParameters);
        }
    }
}
