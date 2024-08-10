
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `answers` (`id`, `answer`, `user_id`, `question_id`, `created_at`) VALUES
(4, '&lt;p&gt;python

def reverse_string(s):
    return s[::-1]&lt;/p&gt;', 1, 1, '2024-05-12 20:34:04'),
(5, '&lt;p&gt;javascript

function reverseString(str) {
    return str.split("").reverse().join("");
}&lt;/p&gt;', 2, 1, '2024-05-12 21:40:59'),
(6, '&lt;p&gt;python

def find_largest_number(arr):
    return max(arr)&lt;/p&gt;', 1, 2, '2024-05-12 21:47:19'),
(7, '&lt;p&gt;python

def factorial(n):
    if n == 0:
        return 1
    return n * factorial(n-1)&lt;/p&gt;', 3, 3, '2024-05-12 21:49:20'),
(8, '&lt;p&gt;javascript

function factorial(n) {
    if (n === 0) {
        return 1;
    }
    return n * factorial(n - 1);
}&lt;/p&gt;', 1, 3, '2024-05-12 21:51:11'),
(9, '&lt;p&gt;javascript

function isAnagram(s, t) {
    return s.split("").sort().join("") === t.split("").sort().join("");
}&lt;/p&gt;', 2, 15, '2024-05-12 22:10:36'),
(10, '&lt;p&gt;python

def is_palindrome(s):
    return s == s[::-1]&lt;/p&gt;', 5, 4, '2024-05-12 21:55:10'),
(11, '&lt;p&gt;python

def longest_word(sentence):
    return max(sentence.split(), key=len)&lt;/p&gt;', 2, 7, '2024-05-12 21:58:24'),
(12, '&lt;p&gt;javascript

function longestWord(sentence) {
    return sentence.split(" ").reduce((a, b) => (a.length >= b.length ? a : b));
}&lt;/p&gt;', 1, 7, '2024-05-12 22:00:03'),
(13, '&lt;p&gt;python

def fibonacci(n):
    fib = [0, 1]
    while len(fib) < n:
        fib.append(fib[-1] + fib[-2])
    return fib&lt;/p&gt;', 3, 8, '2024-05-12 22:00:46'),
(14, '&lt;p&gt;python

class ListNode:
    def __init__(self, val=0, next=None):
        self.val = val
        self.next = next

def reverse_linked_list(head):
    prev = None
    while head:
        temp = head.next
        head.next = prev
        prev = head
        head = temp
    return prev&lt;/p&gt;', 5, 10, '2024-05-12 22:02:43'),
(15, '&lt;p&gt;python

def missing_number(nums):
    n = len(nums)
    total = n * (n + 1) // 2
    return total - sum(nums)&lt;/p&gt;', 4, 11, '2024-05-12 22:05:21'),
(16, '&lt;p&gt;javascript

function missingNumber(nums) {
    const n = nums.length;
    const total = n * (n + 1) / 2;
    return total - nums.reduce((acc, curr) => acc + curr, 0);
}&lt;/p&gt;', 2, 11, '2024-05-12 22:05:23'),
(17, '&lt;p&gt;python

class MyQueue:
    def __init__(self):
        self.stack1 = []
        self.stack2 = []

    def push(self, x):
        self.stack1.append(x)

    def pop(self):
        self.peek()
        return self.stack2.pop()

    def peek(self):
        if not self.stack2:
            while self.stack1:
                self.stack2.append(self.stack1.pop())
        return self.stack2[-1]

    def empty(self):
        return not self.stack1 and not self.stack2&lt;/p&gt;', 5, 13, '2024-05-12 22:09:10'),
(18, '&lt;p&gt;javascript

class ListNode {
    constructor(val = 0, next = null) {
        this.val = val;
        this.next = next;
    }
}

function mergeTwoLists(l1, l2) {
    const dummy = new ListNode(0);
    let current = dummy;
    while (l1 && l2) {
        if (l1.val < l2.val) {
            current.next = l1;
            l1 = l1.next;
        } else {
            current.next = l2;
            l2 = l2.next;
        }
        current = current.next;
    }
    current.next = l1 || l2;
    return dummy.next;
}&lt;/p&gt;', 4, 14, '2024-05-12 22:10:30'),
(19, '&lt;p&gt;python

def is_anagram(s, t):
    return sorted(s) == sorted(t)&lt;/p&gt;', 3, 15, '2024-05-12 22:10:33');




CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `answer_id`, `question_id`, `created_at`) VALUES
(7, 'Nice and concise solution using Pythons slicing!', 1, 4, NULL, '2024-05-12 21:45:12'),
(8, 'I like how you used the split, reverse, and join methods to reverse the string in JavaScript!', 2, 5, NULL, '2024-05-12 21:45:30'),
(9, 'Using max() is a clever way to find the largest number in an array in Python!', 3, 6, NULL, '2024-05-12 21:46:39'),
(11, 'Recursive solution for calculating the factorial in Python is elegant!', 4, 7, NULL, '2024-05-12 22:02:50'),
(12, 'Nice use of recursion to calculate the factorial in JavaScript!', 5, 8, NULL, '2024-05-12 22:03:57'),
(13, 'Simple and effective way to check for a palindrome in Python!', 2, 10, NULL, '2024-05-12 22:04:01'),
(14, 'The use of max with the key argument is a smart way to find the longest word in a sentence in Python!', 1, 11, NULL, '2024-05-12 22:04:03'),
(15, 'Using reduce to find the longest word is a creative solution in JavaScript!', 4, 12, NULL, '2024-05-12 22:04:05'),
(20, 'Using a while loop to generate the Fibonacci sequence is a classic approach in Python!', 3, 13, NULL, '2024-05-12 22:09:18'),
(21, 'mplementing the reverse of a linked list using iterative approach is well-done in Python!', 5, 14, NULL, '2024-05-12 22:09:26'),
(22, 'Clever use of the sum formula to find the missing number in the array in Python!', 2, 15, NULL, '2024-05-12 22:09:33'),
(23, 'HelUsing reduce to find the missing number is a smart approach in JavaScript!lo', 1, 16, NULL, '2024-05-12 22:10:57'),
(24, 'Creative solution to implement a queue using stacks in Python!', 2, 17, NULL, '2024-05-12 22:11:04'),
(25, 'The approach to merge two sorted lists using iteration is clear and concise in JavaScript!', 3, 18, NULL, '2024-05-12 22:12:01'),
(29, 'Using sorted to check for anagrams is a straightforward solution in Python!', 5, 19, NULL, '2024-05-13 22:04:48')
;

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `questions` (`id`, `title`, `description`, `user_id`, `created_at`) VALUES
(1, 'Reverse a String', '&lt;p&gt;Write a function that takes a string as input and returns the string reversed.&lt;/p&gt;', 1, '2024-05-12 21:26:02'),
(2, ' Find the Largest Number in an Array', '&lt;p&gt;Write a function that finds the largest number in an array of integers.&lt;/p&gt;', 3, '2024-05-12 21:26:16'),
(3, 'Calculate the Factorial of a Number', 'Write a function that calculates the factorial of a given number.', 2, '2024-05-12 21:26:25'),
(4, 'Check if a String is a Palindrome', ' Write a function that checks if a given string is a palindrome (reads the same forwards and backwards).', 3, '2024-05-12 21:26:38'),
(5, 'Find the Sum of Two Numbers', 'Write a function that takes two numbers as arguments and returns their sum.', 4, '2024-05-12 21:26:50'),
(6, 'Count the Number of Vowels in a String', 'Write a function that counts the number of vowels (a, e, i, o, u) in a given string.', 5, '2024-05-12 21:27:01'),
(7, 'Find the Longest Word in a Sentence', 'Write a function that finds the longest word in a sentence. Assume the sentence does not have any punctuation.', 3, '2024-05-12 21:27:16'),
(8, 'Calculate the Fibonacci Sequence', '&lt;p&gt;Write a function that generates the Fibonacci sequence up to a certain number of terms.&lt;/p&gt;', 2, '2024-05-12 21:27:47'),
(9, 'Check for Prime Numbers', 'Write a function that checks if a given number is prime.', 1, '2024-05-12 21:28:23'),
(10, ' Reverse a Linked List', '&lt;p&gt;Write a function to reverse a singly linked list.&lt;/p&gt;', 4, '2024-05-12 21:28:43'),
(11, 'Find the Missing Number in an Array', '&lt;p&gt;Given an array containing n distinct numbers taken from 0, 1, 2, ..., n, find the one that is missing from the array.&lt;/p&gt;', 4, '2024-05-12 23:01:55'),
(12, 'Implement Stack using Queues', '&lt;p&gt;I&#039;m  Implement a stack using queues. The stack should support push, pop, top, and empty operations. with&amp;nbsp;&lt;em&gt;&lt;code&gt;System.out.printf();&lt;/code&gt;&lt;/em&gt;&amp;nbsp;function in java .&lt;br&gt;the output format is like this :&lt;/p&gt;\r\n&lt;p&gt;In each line of output there should be two columns: The first column contains the String and is left justified using exactly characters. The second column contains the integer, expressed in exactly digits; if the original input has less than three digits, you must pad your output&#039;s leading digits with zeroes.&lt;br&gt;================================&lt;br&gt;java &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 100&lt;br&gt;cpp &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 065&lt;br&gt;python &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 050&lt;br&gt;================================&lt;/p&gt;', 1, '2024-05-13 22:35:11'),
(13, 'Implement Queue using Stacks', 'Implement a queue using stacks. The queue should support push, pop, peek, and empty operations.', 5, '2024-05-13 22:35:27'),
(14, 'Merge Two Sorted Lists', '&lt;p&gt;Merge two sorted linked lists and return it as a new sorted list. The new list should be made by splicing together the nodes of the first two lists.&lt;/a&gt;&lt;/p&gt;', 3, '2024-05-13 22:35:59'),
(15, 'Determine if Two Strings are Anagrams', '&lt;Given two strings, write a function to determine if they are anagrams of each other.;&lt;/pre&gt;', 5, '2024-05-13 22:36:32')
;



CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `ratings` (`id`, `rate`, `answer_id`, `user_id`) VALUES
(3, 2, 4, 1),
(4, 2, 4, 2),
(5, 2, 5, 3),
(6, 2, 5, 4),
(7, 3, 6, 5),
(10, 3, 7, 1),
(11, 3, 7, 2),
(12, 5, 9, 3),
(13, 3, 10, 4),
(15, 2, 10, 5),
(21, 5, 11, 4),
(22, 1, 13, 3),
(23, 1, 14, 2),
(24, 1, 16, 1),
(25, 1, 16, 1),
(26, 4, 18, 2),
(27, 3, 19, 3),
(28, 5, 18, 4),
(29, 2, 10, 5),
(30, 3, 15, 5),
(31, 5, 13, 5),
(32, 1, 19, 4);



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'Ziyad', 'Zyad@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(1, 'admin', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(3, 'Mishary', 'mishary@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(4, 'Saud', 'saud@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(5, 'Bader', 'bader@gmail.com', '25d55ad283aa400af464c76d713c07ad');


ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);


ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `question_id` (`question_id`);


ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `answer_id` (`answer_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);




ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;


ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;


ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;


ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;




ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;


ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;


ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;


ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE;
COMMIT;

