<!-- footer.php -->
<footer>
    <div class="footer-container">
        <p>&copy; <?php echo date("Y"); ?> VVA. Tous droits réservés.</p>
    </div>
</footer>

<style>
/* Style du footer */
footer {
  background: rgba(255, 255, 255, 0.95);
  box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.08);
  padding: 1.5rem 0;
  margin-top: 3rem;
  position: relative;
  overflow: hidden;
}

footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(to right, #4A6FFF, #FF6B6B);
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
}

footer p {
  color: #666666;
  margin: 0;
  font-size: 0.95rem;
  text-align: center;
  background: none;
  border: none;
  box-shadow: none;
  animation: none;
  padding: 0;
  width: 100%;
}

/* Responsive design pour le footer */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    text-align: center;
    padding: 1rem;
  }
}
</style>
</body>
</html>
